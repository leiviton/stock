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
        $cnpj = $this->companyRepository->find($id)->cnpj;
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
        // $query = \DB::table('outs')->select();
        if ($user->role == 'admin') {
            $query = $this->stockRepository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                    [$data['start'], $data['end']])->where('depositante',$data['cnpj']);
            })->all(['data_atual', 'hora_atual', 'tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'desc_restricao', 'qtd_regul_reser', 'qtd_produto', 'qtd_avariada', 'peca', 'serie']);
        }else {
            $query = $this->stockRepository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                    [$data['start'],$data['end']])->where('tipo_estoque',$data['protocol']);
            })->all(['data_atual', 'hora_atual', 'tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'desc_restricao', 'qtd_regul_reser', 'qtd_produto', 'qtd_avariada', 'peca', 'serie']);
        }

        $name = $user->id.'_'.str_replace(' ','',$user->name);

        for($i = 0; $i < count($query) ; $i++) {
            $query[$i]['data_atual'] = $this->invertDate($query[$i]['data_atual']);
            $query[$i]['data_validade'] = $this->invertDate($query[$i]['data_validade']);
        }

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
}
