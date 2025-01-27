<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace Stock\Http\Controllers\Api\V1\Admin;

use Stock\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stock\Services\RoadService;

class RoadController extends Controller
{

    /**
     * @var RoadService
     */
    private $service;

    /**
     * RoadController constructor.
     * @param RoadService $service
     */
    public function __construct(RoadService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function index($id,Request $request)
    {
        set_time_limit(100000);
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getRoads($request->all(),$id, $lote);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function filterData($id, Request $request)
    {
        set_time_limit(100000);
        if($this->service->diffDays($request->get('start'),$request->get('end')) > 31) {
            return response()->json([ 'title' => 'Erro','status' => 'error', 'message' => 'Intervalo de datas não pode ser maior que 31 dias'],406);
        }else if($this->service->diffDays($request->get('start'),$request->get('end')) < 0) {
            return response()->json([ 'title' => 'Erro','status' => 'error', 'message' => 'Data final maior que data inicial'],406);

        }
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getRoadssData($request->all(),$id,$lote);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function getAll($id,Request $request)
    {
        set_time_limit(100000);
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getAll($id,$lote);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function export(Request $request)
    {
        set_time_limit(100000);
        $data = $request->all();

        $data['start'] = $this->service->invertDate($request->get('start'));
        $data['end'] = $this->service->invertDate($request->get('end'));

        if($data['start'] > $data['end']) {
            return response()->json(['message' => 'Data Final menor que Data Inicial', 'title' => 'Erro',
                'status' => 'error'],406);
        }

        $validator = Validator($data,
            [
                'start' => 'required',
                'end'   => 'required'
            ],
            [
                'start.required' => 'Data Inicial é obritaoria',
                'end.required' => 'Data Final é obritaoria'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result =  $this->service->export($data);

        return response()->json(['message' => 'Arquivo gerado com sucesso', 'link' => env('APP_URL').'/storage/excel/roads/'.$result.'.xlsx'],200);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($id, Request $request)
    {

        $result = $this->service->updateStatus($id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Status atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    public function find(Request $request) {
        return $this->service->findChave($request->get('chave')) == '' ? 'nada' : $this->service->findChave($request->get('chave'));
    }
}
