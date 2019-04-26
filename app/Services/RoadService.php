<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Stock\Repositories\RoadRepository;
use Illuminate\Support\Facades\DB;

class RoadService
{
    /**
     * @var RoadRepository
     */
    private $repository;

    /**
     * RoadService constructor.
     * @param RoadRepository $repository
     */
    public function __construct(RoadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->repository->skipPresenter(false)->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        DB::beginTransaction();
        try {

            $result = $this->repository->create($data);

            DB::commit();

            return ['status' => 'success', 'id' => $result->id];

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $exception->getMessage(), 'title' => 'Erro'];
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getRoads($data)
    {
        return $this->repository->skipPresenter(false)->orderFilter($data);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->skipPresenter(false)->orderByRoads();
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
        $query = $this->repository->scopeQuery(function ($query) use ($data) {
            return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                [$this->invertDate($data['start']), $this->invertDate($data['end'])]);
        })->all(['data_recibimento','tipo_estoque', 'desc_tipo_estoque','cnpj_emissor_nfe', 'razao_social_fornecedor',
            'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
            'data_validade','serie_nf','tipo_nf','qtd_recebida', 'qtd_avariada','desc_restricao','serie', 'peca','qtd_fiscal']);

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
