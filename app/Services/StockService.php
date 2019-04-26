<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 11:19
 */

namespace Stock\Services;


use Stock\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;

class StockService
{
    /**
     * @var StockRepository
     */
    private $stockRepository;

    /**
     * StockService constructor.
     * @param StockRepository $stockRepository
     */
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getStocks($data)
    {
        return $this->stockRepository->skipPresenter(false)->orderFilter($data);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->stockRepository->skipPresenter(false)->orderByStocks();
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

        // $query = \DB::table('outs')->select();
        $query = $this->stockRepository->scopeQuery(function ($query) use ($data) {
            return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                [$this->invertDate($data['start']), $this->invertDate($data['end'])]);
        })->all(['data_atual','hora_atual','tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
            'data_validade', 'desc_restricao', 'qtd_regul_reser', 'qtd_produto', 'qtd_avariada', 'peca', 'serie']);

        $name = (string)$arquivo->getTimestamp();

        \Excel::create($name, function($excel) use($query) {
            $excel->sheet('Sheet 1', function($sheet) use($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/excel');

        return $name;
    }

    /**
     * @param $date
     * @return \DateTime
     * @throws \Exception
     */
    public function invertDate($date)
    {
        $result = '';
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return new \DateTime($result);
        } elseif (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return new \DateTime($result);
        }
    }
}
