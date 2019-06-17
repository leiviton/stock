<?php

namespace Stock\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

            Log::info('Iniciou estoque empresa: ' . $companies[$k]->nome);

            $cnpj = $this->limpaCPF_CNPJ($companies[$k]->cnpj);

            $client = new Client();

            $responseCount = $client->get("http://10.0.0.18:4490/logixrest/kbtr00001/countEstoquePorDepositante/01/$cnpj/S/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);

            $countData = json_decode($responseCount->getBody(true)->getContents());

            $countStock = (int) $countData->data[0]->contador;

            if ($countStock > 0) {

                $start = 1;

                if ($countStock > 5000) {

                    $limit = ceil((float)$countStock / 5000);

                    $end = 5000;

                    for ($j = 0; $j < $limit; $j++) {

                        Log::info("Inicio Consulta estoque $j de $limit | inicio - $start e fim - $end: ". $companies[$k]->nome ." | http://10.0.0.18:4490/logixrest/kbtr00001/estoquePorDepositante/01/$cnpj/$start/$end/S/S/0");

                        $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00001/estoquePorDepositante/01/$cnpj/$start/$end/S/S/0", [
                            'auth' => [
                                'admlog',
                                'Totvs330'
                            ]]);

                        $stocks = json_decode($response->getBody(true)->getContents());

                        $stock = $stocks->data;

                        for ($i = 0; $i < count($stock); $i++) {

                            DB::beginTransaction();
                            try {
                                //dd($stock[$i]);
                                $dataStock = [
                                    'chave_logix' => $stock[$i]->id,
                                    'company_id' => $companies[$k]->id,
                                    'data_geracao' => new \DateTime($stock[$i]->data_atualiza),
                                    'depositante' => $stock[$i]->cnpj_cliente,
                                    'cnpj_origem' => $stock[$i]->cnpj_origem,
                                    'data_atual' => new \DateTime($stock[$i]->data_atual),
                                    'hora_atual' => $stock[$i]->hora_atual,
                                    'tipo_estoque' => $stock[$i]->protocolo,
                                    'desc_tipo_estoque' => $stock[$i]->den_protocolo,
                                    'codigo_produto' => $stock[$i]->cod_item,
                                    'desc_produto' => $stock[$i]->den_item,
                                    'unidade_medida' => $stock[$i]->um,
                                    'lote' => $stock[$i]->lote,
                                    'data_validade' => new \DateTime($stock[$i]->data_validade),
                                    'desc_restricao' => $stock[$i]->den_restricao,
                                    'qtd_regul_reser' => $stock[$i]->qtd_reserva,
                                    'qtd_produto' => $stock[$i]->qtd_disponivel,
                                    'qtd_fiscal' => $stock[$i]->qtd_disponivel,
                                    'qtd_avariada' => $stock[$i]->qtd_avaria,
                                    'avaria' => $stock[$i]->qtd_avaria,
                                    'peca' => $stock[$i]->peca,
                                    'serie' => $stock[$i]->serie
                                ];

                                $this->stockRepository->updateOrCreate(["chave_logix" => $dataStock["chave_logix"]], $dataStock);

                                DB::commit();

                            } catch (\Exception $e) {
                                DB::rollBack();
                                Log::error($e->getMessage());
                            }
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

                    for ($i = 0; $i < count($stock); $i++) {

                        DB::beginTransaction();
                        try {
                            //dd($stock[$i]);
                            $dataStock = [
                                'chave_logix' => $stock[$i]->id,
                                'company_id' => $companies[$k]->id,
                                'data_geracao' => new \DateTime($stock[$i]->data_atualiza),
                                'depositante' => $stock[$i]->cnpj_cliente,
                                'cnpj_origem' => $stock[$i]->cnpj_origem,
                                'data_atual' => new \DateTime($stock[$i]->data_atual),
                                'hora_atual' => $stock[$i]->hora_atual,
                                'tipo_estoque' => $stock[$i]->protocolo,
                                'desc_tipo_estoque' => $stock[$i]->den_protocolo,
                                'codigo_produto' => $stock[$i]->cod_item,
                                'desc_produto' => $stock[$i]->den_item,
                                'unidade_medida' => $stock[$i]->um,
                                'lote' => $stock[$i]->lote,
                                'data_validade' => new \DateTime($stock[$i]->data_validade),
                                'desc_restricao' => $stock[$i]->den_restricao,
                                'qtd_regul_reser' => $stock[$i]->qtd_reserva,
                                'qtd_produto' => $stock[$i]->qtd_disponivel,
                                'qtd_fiscal' => $stock[$i]->qtd_disponivel,
                                'qtd_avariada' => $stock[$i]->qtd_avaria,
                                'avaria' => $stock[$i]->qtd_avaria,
                                'peca' => $stock[$i]->peca,
                                'serie' => $stock[$i]->serie
                            ];

                            $this->stockRepository->updateOrCreate(["chave_logix" => $dataStock["chave_logix"]], $dataStock);

                            DB::commit();

                        } catch (\Exception $e) {
                            DB::rollBack();
                            Log::error($e->getMessage());
                        }
                    }
                }

                Log::info('Finalizou integraçao estoque:' . $countStock);
            }else {

                Log::info('Sem movimento no estoque:' . $countStock);
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
