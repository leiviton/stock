<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Facades\Excel;
use Stock\Exports\Out;
use Stock\Repositories\OutRepository;
use Illuminate\Support\Facades\DB;

class OutService
{
    /**
     * @var OutRepository
     */
    private $repository;

    /**
     * RoadService constructor.
     * @param OutRepository $repository
     */
    public function __construct(OutRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getOuts($data)
    {
        return $this->repository->skipPresenter(false)->orderFilter($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->skipPresenter(false)->orderByOuts();
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
        })->all(['tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
            'data_validade', 'data_envio', 'serie_nf', 'nome_destino_final', 'centro', 'numero_ordem',
            'qtd_enviada', 'serie', 'peca']);

        $name = (string)$arquivo->getTimestamp();

//        $excel = \Export::make('Excel');
//
//        $excel->load($query);
//
//        $excel->save('excel/' . $name . '.xlsx');
        Excel::create($name, function($excel) use($query) {
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
