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
     */
    public function getOuts($data,$id,$lote = '')
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->companyRepository->find($id)->cnpj;
        return $this->repository->skipPresenter(false)->orderFilter($data,$user,$cnpj,$lote);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getAll($id,$lote)
    {
        $user = \Auth::guard()->user();
        $cnpj = $this->companyRepository->find($id)->cnpj;
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
        $user = \Auth::guard()->user();
        // $query = \DB::table('outs')->select();
        if ($user->role == 'admin') {
            $query = $this->repository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                    [$data['start'], $data['end']])->where('depositante',$data['cnpj']);
            })->all(['tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'data_envio', 'serie_nf', 'nome_destino_final', 'centro', 'numero_ordem',
                'qtd_enviada', 'serie', 'peca']);
        }else {
            $query = $this->repository->scopeQuery(function ($query) use ($data) {
                return $query->whereRaw('data_geracao BETWEEN ? AND ?',
                    [$data['start'], $data['end']])->where('tipo_estoque',$data['protocol']);
            })->all(['tipo_estoque', 'desc_tipo_estoque', 'codigo_produto', 'desc_produto', 'unidade_medida', 'lote',
                'data_validade', 'data_envio', 'serie_nf', 'nome_destino_final', 'centro', 'numero_ordem',
                'qtd_enviada', 'serie', 'peca']);
        }

        $name = $user->id.'_'.str_replace(' ','',$user->name);

        for($i = 0; $i < count($query) ; $i++) {
            $dataEnvio = (string) $query[$i]['data_envio'];
            $query[$i]['data_envio'] = $this->invertDate(substr($dataEnvio,0,10));
            $query[$i]['data_validade'] = $this->invertDate(substr((string)  $query[$i]['data_validade'],0,10));
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
        $result = '';
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
        }
    }
}
