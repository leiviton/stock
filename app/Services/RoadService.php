<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Stock\Repositories\CompanyRepository;
use Stock\Repositories\RoadRepository;
use Illuminate\Support\Facades\DB;

class RoadService
{
    /**
     * @var RoadRepository
     */
    private $repository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * RoadService constructor.
     * @param RoadRepository $repository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(RoadRepository $repository, CompanyRepository $companyRepository)
    {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
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
     * @param $id
     * @param string $lote
     * @return mixed
     * @throws \Exception
     */
    public function getRoadssData($data, $id, $lote = '')
    {
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        $data['end'] = $this->invertDate($data['end']);
        $data['start'] = $this->invertDate($data['start']);
        return $this->repository->skipPresenter(false)->orderFilterData($data,$cnpj,$lote);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
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
     * @param $id
     * @param string $lote
     * @return mixed
     */
    public function getRoads($data,$id,$lote = '')
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        return $this->repository->skipPresenter(false)->orderFilter($data,$user,$cnpj,$lote);
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
        return $this->repository->skipPresenter(false)->orderByRoads($user,$cnpj,$lote);
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
            $query = $this->repository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_recebimento BETWEEN ? AND ?',
                    [$data['start'], $data['end']])->where('depositante',$this->limpaCPF_CNPJ($data['cnpj']));
            })->orderBy('data_recebimento','asc')->all(['data_recebimento', 'tipo_estoque', 'desc_tipo_estoque', 'cnpj_emissor_nfe', 'razao_social_fornecedor',
                'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'serie_nf', 'tipo_nf', 'qtd_recebida', 'qtd_avariada', 'desc_restricao', 'serie', 'peca', 'qtd_fiscal']);
        }else {
            $query = $this->repository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_recebimento BETWEEN ? AND ?',
                    [$data['start'], $data['end']])->where('tipo_estoque',$data['protocol']);
            })->orderBy('data_recebimento','asc')->all(['data_recebimento', 'tipo_estoque', 'desc_tipo_estoque', 'cnpj_emissor_nfe', 'razao_social_fornecedor',
                'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'serie_nf', 'tipo_nf', 'qtd_recebida', 'qtd_avariada', 'desc_restricao', 'serie', 'peca', 'qtd_fiscal']);
        }

        $name = $user->id.'_'.str_replace(' ','',$user->name);

        for($i = 0; $i < count($query) ; $i++) {
            $query[$i]['data_recebimento'] = $this->invertDate($query[$i]['data_recebimento']);
            $query[$i]['data_validade'] = $this->invertDate($query[$i]['data_validade']);
        }

        \Excel::create($name, function($excel) use($query) {
            $excel->sheet('Sheet 1', function($sheet) use($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/roads');

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

    /**
     * @param $start
     * @param $end
     * @return bool|\DateInterval|int
     * @throws \Exception
     */
    public function diffDays($start, $end) {
        $start = new \DateTime($this->invertDate($start));
        $end = new \DateTime($this->invertDate($end));
        if ($start > $end) {
            return -1;
        } else {
            return $start->diff($end)->days;
        }
    }

    public function findChave($get)
    {
        return $this->repository->findByLogix($get);
    }
}
