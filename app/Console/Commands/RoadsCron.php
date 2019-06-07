<?php

namespace Stock\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\OutRepository;
use Stock\Repositories\ProtocolRepository;
use Stock\Repositories\RoadRepository;
use Stock\Repositories\StockRepository;

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
     * @var ProtocolRepository
     */
    private $repository;
    /**
     * @var RoadRepository
     */
    private $roadRepository;
    /**
     * @var OutRepository
     */
    private $outRepository;
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
     * @param ProtocolRepository $repository
     * @param RoadRepository $roadRepository
     * @param OutRepository $outRepository
     * @param StockRepository $stockRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(ProtocolRepository $repository, RoadRepository $roadRepository,
                                OutRepository $outRepository, StockRepository $stockRepository,
                                CompanyRepository $companyRepository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->roadRepository = $roadRepository;
        $this->outRepository = $outRepository;
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
        DB::table('stocks')->truncate();

        $companies = $this->companyRepository->all();

        foreach ($companies as $company) {

            $company->cnpj = $this->limpaCPF_CNPJ($company->cnpj);

            $client = new Client();

            $dataNow = date_format(new \DateTime(), 'd-m-Y');

            $response = $client->get("http://10.0.0.18:4490/logixrest/kbtr00002/entradaporDepositanteData/01/$company->cnpj/1/1000/11-05-2019/$dataNow/N/0", [
                'auth' => [
                    'admlog', 'Totvs330'
                ]]);

            $data = json_decode($response->getBody(true)->getContents());
            // dd($data->data);
            $entradas = $data->data;

            for ($i = 0; $i < count($entradas); $i++) {
                // dd($entradas[$i]);
                $data1 = [
                    'chave_logix' => $entradas[$i]->id,
                    'company_id' => 1,
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
                    'serie_nf' => str_replace(' ','',$entradas[$i]->num_nf . '-' . $entradas[$i]->ser_nf),
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
