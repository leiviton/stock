<?php

namespace Stock\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\RoadRepository;

class RoadsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roads:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var RoadRepository
     */
    private $roadRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * Create a new command instance.
     *
     * @param RoadRepository $roadRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(RoadRepository $roadRepository,
                                CompanyRepository $companyRepository)
    {
        parent::__construct();
        $this->roadRepository = $roadRepository;
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
        $companies = $this->companyRepository->all();

        $k = 0;

        $count = count($companies);

        do {

            //for ($k = 0; $k < count($companies); $k = $k + 1) {

            $cnpj = $this->limpaCPF_CNPJ($companies[$k]->cnpj);

            $client = new Client();

            $dataNow = new Carbon();

            $dataNowReverse = $dataNow->subDay(1)->format('d-m-Y');

            //$dataNowReverse = '13-06-2019';

            $responseCount = $client->get("http://10.0.0.18:4490/logixrest/kbtr00002/countEntradaporDepositanteData/01/$cnpj/01-01-2019/$dataNowReverse/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);

            $countData = json_decode($responseCount->getBody(true)->getContents());

            $countRoads = (int)$countData->data[0]->contador;

            Log::info("Iniciou empresa: $k " . $companies[$k]->nome);

            Log::info("Contador de entradas: $k " . $companies[$k]->nome . " | quantidade: $count | http://10.0.0.18:4490/logixrest/kbtr00002/countEntradaporDepositanteData/01/$cnpj/01-01-2019/$dataNowReverse/0");

            if ($countRoads > 0) {

                $start = 1;

                if ($countRoads > 10000) {
                    $limit = ceil((float)$countRoads / 10000);

                    $end = 10000;

                    for ($j = 0; $j < $limit; $j++) {
                        Log::info("Inicio Consulta Entradas $j de $limit | inicio - $start e fim - $end: " . $companies[$k]->nome . "http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$cnpj/$start/$end/01-01-2019/$dataNowReverse/S/0");

                        $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$cnpj/$start/$end/01-01-2019/$dataNowReverse/S/0", [
                            'auth' => [
                                'admlog', 'Totvs330'
                            ]]);

                        $data = json_decode($response->getBody(true)->getContents());
                        // dd($data->data);
                        $entradas = $data->data;

                        // dd($entradas[$i]);
                        DB::beginTransaction();
                        try {
                            for ($i = 0; $i < count($entradas); $i++) {
                                $verifyRoads = $this->roadRepository->findByLogix($entradas[$i]->id);

                                if ($verifyRoads == '') {
                                    Log::info('Registro chave não encontrado');
                                } else {
                                    Log::info('Registro chave: ' . $verifyRoads);
                                }

                                if ($verifyRoads == '') {
                                    Log::info('Registro entrada novo: ' . $entradas[$i]->id);
                                    $data1 = [
                                        'chave_logix' => $entradas[$i]->id,
                                        'company_id' => $companies[$k]->id,
                                        'data_geracao' => new \DateTime($entradas[$i]->data_atualiza),
                                        'depositante' => $entradas[$i]->cnpj_cliente,
                                        'razao_social' => $entradas[$i]->razao_social,
                                        'data_recebimento' => new \DateTime($entradas[$i]->dat_entrada_nf),
                                        'tipo_estoque' => $entradas[$i]->protocolo,
                                        'desc_tipo_estoque' => $entradas[$i]->den_protocolo,
                                        'cnpj_emissor_nfe' => $entradas[$i]->cnpj_emissor,
                                        'razao_social_fornecedor' => $entradas[$i]->razao_social,
                                        'codigo_produto' => $entradas[$i]->cod_item,
                                        'desc_produto' => $entradas[$i]->den_item,
                                        'unidade_medida' => $entradas[$i]->um,
                                        'lote' => $entradas[$i]->lote,
                                        'data_validade' => new \DateTime($entradas[$i]->data_validade),
                                        'serie_nf' => str_replace(' ', '', $entradas[$i]->num_nf . '-' . $entradas[$i]->ser_nf),
                                        'tipo_nf' => '5',
                                        'desc_restricao' => $entradas[$i]->des_restricao,
                                        'serie' => $entradas[$i]->serie,
                                        'peca' => $entradas[$i]->peca,
                                        'qtd_recebida' => (int)$entradas[$i]->qtd_recebida,
                                        'qtd_fiscal' => (int)$entradas[$i]->qtd_declarada_nf,
                                    ];
                                    //dd($data1["qtd_fiscal"]);
                                    $this->roadRepository->firstOrCreate($data1);
                                    //dd($itemEnd);
                                } else {
                                    Log::info('Registro encontrado chave: ' . $verifyRoads);
                                }
                            }

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            Log::error("Erro entrada: $i |" . $e->getMessage());
                        }

                        Log::info('Finalizou registros entradas: ' . $start . ' a ' . $end);

                        $start = $end + 1;
                        $end = $end + 10000;
                    }

                    Log::info("Finalizou integraçao saidas: $dataNowReverse, quantidade $countRoads");
                } else {

                    $end = $countRoads;

                    Log::info("Inicio Consulta: " . $companies[$k]->nome . "http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$cnpj/$start/$end/01-01-2019/$dataNowReverse/S/0");

                    $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$cnpj/$start/$end/01-01-2019/$dataNowReverse/S/0", [
                        'auth' => [
                            'admlog', 'Totvs330'
                        ]]);

                    $data = json_decode($response->getBody(true)->getContents());
                    // dd($data->data);
                    $entradas = $data->data;

                    DB::beginTransaction();
                    // dd($entradas[$i]);
                    try {
                        for ($i = 0; $i < count($entradas); $i++) {

                            $verifyRoads = $this->roadRepository->findByLogix($entradas[$i]->id);

                            if ($verifyRoads == '') {
                                Log::info('Registro chave não encontrado');
                            } else {
                                Log::info('Registro chave: ' . $verifyRoads);
                            }

                            if ($verifyRoads == '') {
                                $data1 = [
                                    'chave_logix' => $entradas[$i]->id,
                                    'company_id' => $companies[$k]->id,
                                    'data_geracao' => new \DateTime($entradas[$i]->data_atualiza),
                                    'depositante' => $entradas[$i]->cnpj_cliente,
                                    'razao_social' => $entradas[$i]->razao_social,
                                    'data_recebimento' => new \DateTime($entradas[$i]->dat_entrada_nf),
                                    'tipo_estoque' => $entradas[$i]->protocolo,
                                    'desc_tipo_estoque' => $entradas[$i]->den_protocolo,
                                    'cnpj_emissor_nfe' => $entradas[$i]->cnpj_emissor,
                                    'razao_social_fornecedor' => $entradas[$i]->razao_social,
                                    'codigo_produto' => $entradas[$i]->cod_item,
                                    'desc_produto' => $entradas[$i]->den_item,
                                    'unidade_medida' => $entradas[$i]->um,
                                    'lote' => $entradas[$i]->lote,
                                    'data_validade' => new \DateTime($entradas[$i]->data_validade),
                                    'serie_nf' => str_replace(' ', '', $entradas[$i]->num_nf . '-' . $entradas[$i]->ser_nf),
                                    'tipo_nf' => '5',
                                    'desc_restricao' => $entradas[$i]->des_restricao,
                                    'serie' => $entradas[$i]->serie,
                                    'peca' => $entradas[$i]->peca,
                                    'qtd_recebida' => (int)$entradas[$i]->qtd_recebida,
                                    'qtd_fiscal' => (int)$entradas[$i]->qtd_declarada_nf,
                                ];
                                //dd($data1["qtd_fiscal"]);
                                $this->roadRepository->firstOrCreate($data1);
                                //dd($itemEnd);
                            } else {
                                Log::info('Registro encontrado chave: ' . $verifyRoads);
                            }
                        }
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error("Erro entrada: $i |" . $e->getMessage());
                    }

                    Log::info('Finalizou registros entradas: ' . $start . ' a ' . $end);
                }
            } else {
                Log::info("Sem movimentos: $dataNowReverse, quantidade $countRoads, empresas: $count");
            }

            $k++;
            Log::info("Indice array emrpesas: $k");
        } while ($k < $count);

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
