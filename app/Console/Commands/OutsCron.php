<?php

namespace Stock\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\OutRepository;

class OutsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'outs:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get outs client logix';

    /**
     * @var OutRepository
     */
    private $outRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * Create a new command instance.
     *
     * @param OutRepository $outRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(OutRepository $outRepository,
                                CompanyRepository $companyRepository)
    {
        parent::__construct();
        $this->outRepository = $outRepository;
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

            $dataNow = new Carbon();

            $dataNow = $dataNow->subDay(1);

            $dataNowReverse = date_format($dataNow, 'd-m-Y');

            $company->cnpj = $this->limpaCPF_CNPJ($company->cnpj);

            $responseSaida = $client->get("http://10.0.0.18:4490/logixrest/kbtr00003/saidasporDepositanteData/01/$company->cnpj/1/1000/$dataNowReverse/$dataNowReverse/N/0", [
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
