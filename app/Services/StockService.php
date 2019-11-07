<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 11:19
 */

namespace Stock\Services;


use Stock\Repositories\CompanyRepository;
use Stock\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;

class StockService
{
    /**
     * @var StockRepository
     */
    private $stockRepository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * StockService constructor.
     * @param StockRepository $stockRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(StockRepository $stockRepository, CompanyRepository $companyRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param $data
     * @param $id
     * @param string $lote
     * @return mixed
     */
    public function getStocks($data,$id,$lote = '')
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        return $this->stockRepository->skipPresenter(false)->orderFilter($data,$user,$cnpj,$lote);
    }

    /**
     * @param $id
     * @param $lote
     * @return mixed
     */
    public function getAll($id,$lote)
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        return $this->stockRepository->skipPresenter(false)->orderByStocks($user,$cnpj,$lote);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->stockRepository->skipPresenter(false)->find($id);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function create($data)
    {
        DB::beginTransaction();
        try{

            $result = $this->stockRepository->create($data);

            DB::commit();

            return ['status'=>'success','id'=>$result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status'=>'error','message'=>$exception->getMessage(),'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function export($data)
    {
        $arquivo = new \DateTime();
        $user = \Auth::guard()->user();
        $data['cnpj'] = $this->limpaCPF_CNPJ($data['cnpj']);

        // $query = \DB::table('outs')->select();
        if ($user->role == 'admin' || $user->role == 'drs-admin') {
            $query = $this->stockRepository->getQueryAdmin($data);
        }else {
            $query = $this->stockRepository->getQueryUser($data);
        }

        $name = $user->id.'_'.str_replace(' ','',$user->name);

        for($i = 0; $i < count($query) ; $i++) {
            $query[$i]['Data_Validade'] = $this->invertDate($query[$i]['Data_Validade']);
        }
        //dd($query);

        \Excel::create($name, function($excel) use($query) {
            $excel->sheet('Sheet 1', function($sheet) use($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/stocks');

        return $name;
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function invertDate($date)
    {
        $result = '';
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
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

    public function groupStock()
    {
        return $this->stockRepository->groupStock();
    }

    public function getChave($chave)
    {
        return $this->stockRepository->findByLogix($chave);
    }
}
