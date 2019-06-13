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

        for ($k = 0; $k < count($companies); $k++) {

            Log::info('Iniciou empresa: ' . $companies[$k]->nome);

            $cnpj = $this->limpaCPF_CNPJ($companies[$k]->cnpj);

            $client = new Client();

            $dataNow = new Carbon();

            $dataNow = $dataNow->subDay(1);

            $dataNowReverse = date_format($dataNow, 'd-m-Y');

            $now = new Carbon();

            $now = date_format($now, 'd-m-Y');

            $responseCount = $client->get("http://10.0.0.31:4488/logixrest/kbtr00002/countEntradaporDepositanteData/01/$cnpj/$dataNowReverse/$dataNowReverse/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);

            $countData = json_decode($responseCount->getBody(true)->getContents());

            $countRoads = (int)$countData->data[0]->contador;

            if($countRoads > 0) {
                if ($countRoads > 5000) {
                    $limit = ceil((float)$countRoads / 5000);
                    $end = 5000;
                } else {
                    $limit = 1;
                    $end = $countRoads;
                }

                $start = 1;

                for ($j = 0; $j < $limit; $j++) {

                    $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$cnpj/$start/$end/$dataNowReverse/$dataNowReverse/S/0", [
                        'auth' => [
                            'admlog', 'Totvs330'
                        ]]);

                    $data = json_decode($response->getBody(true)->getContents());
                    // dd($data->data);
                    $entradas = $data->data;
                    DB::beginTransaction();
                    try {
                        for ($i = 0; $i < count($entradas); $i++) {
                            // dd($entradas[$i]);
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
                            $this->roadRepository->updateOrCreate(["chave_logix" => $data1["chave_logix"]], $data1);
                            //dd($itemEnd);
                        }
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error($e->getMessage());
                    }

                    Log::info('Finalizou registros entradas: ' . $start . ' a ' . $end);
                    $start = $end + 1;
                    $end = $end + 5000;
                }
            }
            Log::info("Finalizou integraçao entradas: $dataNowReverse, quantidade $countRoads");
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
