<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\OutRepository;
use Illuminate\Support\Facades\DB;

class OutService
{
    /**
     * @var OutRepository
     */
    private $repository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * RoadService constructor.
     * @param OutRepository $repository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(OutRepository $repository, CompanyRepository $companyRepository)
    {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param $data
     * @param $id
     * @param string $lote
     * @return mixed
     * @throws \Exception
     */
    public function getOuts($data,$id,$lote = '')
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        if($data['field'] == 'data_envio') {
            $data['value'] = $this->invertDate($data['value']);
        }
        return $this->repository->skipPresenter(false)->orderFilter($data,$user,$cnpj,$lote);
    }

    /**
     * @param $data
     * @param $id
     * @param string $lote
     * @return mixed
     * @throws \Exception
     */
    public function getOutsData($data, $id, $lote = '')
    {
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        $data['end'] = $this->invertDate($data['end']);
        $data['start'] = $this->invertDate($data['start']);
        return $this->repository->skipPresenter(false)->orderFilterData($data,$cnpj,$lote);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getAll($id,$lote)
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->limpaCPF_CNPJ($this->companyRepository->find($id)->cnpj);
        return $this->repository->skipPresenter(false)->orderByOuts($user,$cnpj,$lote);
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
     * @return string
     * @throws \Exception
     */
    public function export($data)
    {
        $user = \Auth::guard()->user();

        if ($user->role == 'admin') {
            $query = $this->repository->getQueryAdmin($data);
        }else {
            $query = $this->repository->getQueryUser($data);
        }

        $name = $user->id.'_'.str_replace(' ','',$user->name);

        for($i = 0; $i < count($query) ; $i++) {
            $dataEnvio = (string) $query[$i]['Envio'];
            $query[$i]['Envio'] = $this->invertDate(substr($dataEnvio,0,10));
            $query[$i]['Validade'] = $this->invertDate(substr((string)  $query[$i]['Validade'],0,10));
        }

        Excel::create($name, function($excel) use($query) {
            $excel->sheet('Sheet 1', function($sheet) use($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/outs');

        return $name;
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function invertDate($date)
    {
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
        }
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
