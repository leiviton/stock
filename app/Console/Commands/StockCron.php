<?php

namespace Stock\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Stock\Mail\IntegrationLogix;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\StockRepository;

class StockCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var StockRepository
     */
    private $stockRepository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * Create a new command instance.
     *
     * @param StockRepository $stockRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(StockRepository $stockRepository,
                                CompanyRepository $companyRepository)
    {
        parent::__construct();
        $this->stockRepository = $stockRepository;
        $this->companyRepository = $companyRepository;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $log = new Logger('stock');

        $log->pushHandler(new StreamHandler(storage_path().'/logs/logix.log'));

        DB::beginTransaction();
        try {
            DB::table('stocks')->truncate();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        $companies = $this->companyRepository->all();

        for ($k = 0; $k < count($companies); $k++) {

            $log::info('Iniciou estoque empresa: ' . $companies[$k]->nome);

            $cnpj = $this->limpaCPF_CNPJ($companies[$k]->cnpj);

            $client = new Client();

            $responseCount = $client->get("http://10.0.0.18:4490/logixrest/kbtr00001/countEstoquePorDepositante/01/$cnpj/S/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);

            $countData = json_decode($responseCount->getBody(true)->getContents());

            $countStock = (int)$countData->data[0]->contador;

            if ($countStock > 0) {

                $start = 1;

                if ($countStock > 5000) {

                    $limit = ceil((float)$countStock / 5000);

                    $end = 5000;

                    for ($j = 0; $j < $limit; $j++) {

                        $log::info("Inicio Consulta estoque $j de $limit | inicio - $start e fim - $end: " . $companies[$k]->nome . " | http://10.0.0.18:4490/logixrest/kbtr00001/estoquePorDepositante/01/$cnpj/$start/$end/S/S/0");

                        $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00001/estoquePorDepositante/01/$cnpj/$start/$end/S/S/0", [
                            'auth' => [
                                'admlog',
                                'Totvs330'
                            ]]);

                        $stocks = json_decode($response->getBody(true)->getContents());

                        $stock = $stocks->data;

                        DB::beginTransaction();
                        try {
                            for ($i = 0; $i < count($stock); $i++) {

                                $verifyOuts = $this->stockRepository->findByLogix(trim($stock[$i]->id));

                                if ($verifyOuts != 0) {
                                    $log::info('Registro estoque chave: ' . $verifyOuts);
                                }

                                if ($verifyOuts == 0) {
                                    //dd($stock[$i]);
                                    $dataStock = [
                                        'chave_logix' => trim($stock[$i]->id),
                                        'company_id' => $companies[$k]->id,
                                        'data_geracao' => new \DateTime($stock[$i]->data_atualiza),
                                        'depositante' => trim($stock[$i]->cnpj_cliente),
                                        'cnpj_origem' => trim($stock[$i]->cnpj_origem),
                                        'data_atual' => new \DateTime($stock[$i]->data_atual),
                                        'hora_atual' => trim($stock[$i]->hora_atual),
                                        'tipo_estoque' => trim($stock[$i]->protocolo),
                                        'desc_tipo_estoque' => trim($stock[$i]->den_protocolo),
                                        'codigo_produto' => trim($stock[$i]->cod_item),
                                        'desc_produto' => trim($stock[$i]->den_item),
                                        'unidade_medida' => trim($stock[$i]->um),
                                        'lote' => trim($stock[$i]->lote),
                                        'data_validade' => new \DateTime($stock[$i]->data_validade),
                                        'desc_restricao' => trim($stock[$i]->den_restricao),
                                        'qtd_regul_reser' => trim($stock[$i]->qtd_reserva),
                                        'qtd_produto' => trim($stock[$i]->qtd_disponivel),
                                        'qtd_fiscal' => trim($stock[$i]->qtd_disponivel),
                                        'qtd_avariada' => trim($stock[$i]->qtd_avaria),
                                        'avaria' => trim($stock[$i]->qtd_avaria),
                                        'peca' => trim($stock[$i]->peca),
                                        'serie' => trim($stock[$i]->serie)
                                    ];

                                    $this->stockRepository->create($dataStock);
                                }
                            }
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            $log::error($e->getMessage());
                        }

                        $start = $end + 1;
                        $end = $end + 5000;
                    }
                } else {

                    $end = $countStock;

                    $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00001/estoquePorDepositante/01/$cnpj/$start/$end/S/S/0", [
                        'auth' => [
                            'admlog',
                            'Totvs330'
                        ]]);

                    $stocks = json_decode($response->getBody(true)->getContents());

                    $stock = $stocks->data;

                    DB::beginTransaction();
                    try {
                        for ($i = 0; $i < count($stock); $i++) {
                            //dd($stock[$i]);
                            $verifyOuts = $this->stockRepository->findByLogix($stock[$i]->id);

                            if ($verifyOuts != 0) {
                                $log::info('Registro estoque chave: ' . $verifyOuts);
                            } else {
                                $log::info('Registro estoque nao encontrado: ' . $stock[$i]->id);
                            }

                            if ($verifyOuts == 0) {
                                $dataStock = [
                                    'chave_logix' => trim($stock[$i]->id),
                                    'company_id' => $companies[$k]->id,
                                    'data_geracao' => new \DateTime($stock[$i]->data_atualiza),
                                    'depositante' => trim($stock[$i]->cnpj_cliente),
                                    'cnpj_origem' => trim($stock[$i]->cnpj_origem),
                                    'data_atual' => new \DateTime($stock[$i]->data_atual),
                                    'hora_atual' => trim($stock[$i]->hora_atual),
                                    'tipo_estoque' => trim($stock[$i]->protocolo),
                                    'desc_tipo_estoque' => trim($stock[$i]->den_protocolo),
                                    'codigo_produto' => trim($stock[$i]->cod_item),
                                    'desc_produto' => trim($stock[$i]->den_item),
                                    'unidade_medida' => trim($stock[$i]->um),
                                    'lote' => trim($stock[$i]->lote),
                                    'data_validade' => new \DateTime($stock[$i]->data_validade),
                                    'desc_restricao' => trim($stock[$i]->den_restricao),
                                    'qtd_regul_reser' => trim($stock[$i]->qtd_reserva),
                                    'qtd_produto' => trim($stock[$i]->qtd_disponivel),
                                    'qtd_fiscal' => trim($stock[$i]->qtd_disponivel),
                                    'qtd_avariada' => trim($stock[$i]->qtd_avaria),
                                    'avaria' => trim($stock[$i]->qtd_avaria),
                                    'peca' => trim($stock[$i]->peca),
                                    'serie' => trim($stock[$i]->serie)
                                ];

                                $this->stockRepository->create($dataStock);
                            }
                        }
                        DB::commit();

                    } catch (\Exception $e) {
                        DB::rollBack();
                        $log::error($e->getMessage());
                    }
                }

                Log::info('Finalizou integraçao estoque:' . $countStock);

                $erro["chave_logix"] = '';
                $erro['error'] = 'Finalizado integraçao saidas: '.$cnpj.' Sem movimento';
                //\Mail::to(['leiviton.silva@drsgroup.com.br','leiviton.silva@drsgroup.com.br'])->send(new IntegrationLogix('leiviton.silva@drsgroup.com.br', $erro));
            } else {

                $log::info('Sem movimento no estoque:' . $countStock);
            }
        }
    }

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }
}
