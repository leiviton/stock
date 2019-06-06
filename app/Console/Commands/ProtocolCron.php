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

class ProtocolCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'protocols:cron';

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
        $client = new Client();
        $responseSaida = $client->get("http://10.0.0.18:4499/logixrest/kbtr00003/saidasporDepositanteData/01/056994502000130/1/1000/04-06-2019/06-06-2019/N/0", [
            'auth' => [
                'admlog',
                'Totvs330'
            ]]);
        $saidas = json_decode($responseSaida->getBody(true)->getContents());
        $saida = $saidas->data;
        //dd($saida);
        for ($i = 0; $i < count($saida); $i++) {
            //dd($saida[$i]);
            $dataSaida = [
                'chave_logix' => $saida[$i]->id,
                'company_id' => 1,
                'data_geracao' => new \DateTime($saida[$i]->data_atualiza),
                'depositante' => $saida[$i]->cnpj_cliente_depos,
                'razao_social' => $saida[$i]->razao_social,
                'tipo_estoque' => $saida[$i]->protocolo,
                'codigo_produto' => $saida[$i]->cod_item,
                'desc_produto' => $saida[$i]->den_item,
                'desc_tipo_estoque' => $saida[$i]->den_protocolo,
                'unidade_medida' => $saida[$i]->um,
                'lote' => $saida[$i]->lote,
                'data_validade' => new \DateTime($saida[$i]->dat_hor_validade),
                'data_envio' => new \DateTime($saida[$i]->dat_solic_envio),
                'nota_fiscal' => '15',
                'serie_nf' => str_replace(' ','',$saida[$i]->serie_nota_fiscal),
                'nome_destino_final' => $saida[$i]->nome_dest_final,
                'centro' => $saida[$i]->centro,
                'numero_ordem' => $saida[$i]->num_ordem,
                'qtd_enviada' => $saida[$i]->qtd_enviada,
                'serie' => $saida[$i]->serie,
                'peca' => $saida[$i]->peca,
                'pedido_venda' => $saida[$i]->id_protheus
            ];

            $this->outRepository->updateOrCreate(["chave_logix" => $dataSaida["chave_logix"]], $dataSaida);
        }
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

        DB::table('stocks')->truncate();

        foreach ($companies as $company) {

            $company->cnpj = $this->limpaCPF_CNPJ($company->cnpj);

            $result = DB::connection('sqlsrv')->table('logix.wms_tip_estoque')->where('sit_registro', 1)->where('empresa_deposit', $this->limpaCPF_CNPJ($company->cnpj))->get();

            for ($i = 0; $i < count($result); $i++) {
                //dd($result[$i]->empresa);
                $data = [
                    "empresa" => rtrim($result[$i]->empresa),
                    "tip_estoque" => rtrim($result[$i]->tip_estoque),
                    "abrang" => rtrim($result[$i]->abrang),
                    "empresa_deposit" => rtrim($result[$i]->empresa_deposit),
                    "des_tip_estoque" => rtrim($result[$i]->des_tip_estoque),
                    "des_reduz_tip_estoque" => rtrim($result[$i]->des_reduz_tip_estoque),
                    "padrao" => rtrim($result[$i]->padrao),
                    "sit_registro" => rtrim($result[$i]->sit_registro)
                ];

                $this->repository->updateOrCreate(["tip_estoque" => $data["tip_estoque"]], $data);
            }

            $client = new Client();

            $dataNow = date_format(new \DateTime(), 'd-m-Y');


            $company->cnpj = $this->limpaCPF_CNPJ($company->cnpj);

            $responseSaida = $client->get("http://10.0.0.18:4499/logixrest/kbtr00003/saidasporDepositanteData/01/$company->cnpj/1/1000/04-03-2019/04-03-2019/N/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);
            $saidas = json_decode($responseSaida->getBody(true)->getContents());
            $saida = $saidas->data;
            for ($i = 0; $i < count($saida); $i++) {
                //dd($saida[$i]);
                $dataSaida = [
                    'chave_logix' => $saida[$i]->id,
                    'company_id' => $company->id,
                    'data_geracao' => new \DateTime($saida[$i]->data_atualiza),
                    'depositante' => $saida[$i]->cnpj_cliente_depos,
                    'razao_social' => $saida[$i]->razao_social,
                    'tipo_estoque' => $saida[$i]->protocolo,
                    'codigo_produto' => $saida[$i]->cod_item,
                    'desc_produto' => $saida[$i]->den_item,
                    'desc_tipo_estoque' => $saida[$i]->den_protocolo,
                    'unidade_medida' => $saida[$i]->um,
                    'lote' => $saida[$i]->lote,
                    'data_validade' => new \DateTime($saida[$i]->dat_hor_validade),
                    'data_envio' => new \DateTime($saida[$i]->dat_solic_envio),
                    'nota_fiscal' => '15',
                    'serie_nf' => $saida[$i]->serie_nota_fiscal,
                    'nome_destino_final' => $saida[$i]->nome_dest_final,
                    'centro' => $saida[$i]->centro,
                    'numero_ordem' => $saida[$i]->num_ordem,
                    'qtd_enviada' => $saida[$i]->qtd_enviada,
                    'serie' => $saida[$i]->serie,
                    'peca' => $saida[$i]->peca,
                    'pedido_venda' => $saida[$i]->id_protheus
                ];

                $this->outRepository->updateOrCreate(["chave_logix" => $dataSaida["chave_logix"]], $dataSaida);
            }

            $response = $client->get("http://10.0.0.18:4499/logixrest/kbtr00002/entradaporDepositanteData/01/$company->cnpj/1/1000/04-03-2019/04-05-2019/N/0", [
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
                    'serie_nf' => $entradas[$i]->num_nf . '-' . $entradas[$i]->ser_nf,
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

            $response = $client->get("http://10.0.0.18:4499/logixrest/kbtr00001/estoquePorDepositante/01/$company->cnpj/1/500/S/N/0", [
                'auth' => [
                    'admlog',
                    'Totvs330'
                ]]);
            $stocks = json_decode($response->getBody(true)->getContents());

            $stock = $stocks->data;

            for ($i = 0; $i < count($stock); $i++) {
                //dd($stock[$i]);
                $dataStock = [
                    'chave_logix' => $stock[$i]->id,
                    'company_id' => 1,
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
