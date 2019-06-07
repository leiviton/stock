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

class ProtocolsCron extends Command
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
    protected $description = 'Get outs client logix';

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
        $companies = $this->companyRepository->all();

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
