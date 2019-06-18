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
use Stock\Services\StockService;

class StocksController extends Controller
{

    /**
     * @var StockService
     */
    private $service;

    /**
     * UserController constructor.
     * @param StockService $service
     */
    public function __construct(StockService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $id
     * @param $lote
     * @param Request $request
     * @return mixed
     */
    public function index($id,Request $request)
    {
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getStocks($request->all(),$id,$lote);
    }

    /**
     * @return mixed
     */
    public function getAll($id,Request $request)
    {
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getAll($id,$lote);
    }

    public function groupStocks() {
        return $this->service->groupStock();
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function export(Request $request)
    {
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

        return response()->json(['message' => 'Arquivo gerado com sucesso', 'link' => env('APP_URL').'/storage/excel/stocks/'.$result.'.xlsx'],200);
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
    public function updatePassword($id, Request $request)
    {
        $validator = Validator($request->all(),
            [
                'password' => 'required|min:6'
            ],
            [
                'password.required' => 'Senha é obritaoria',
                'password.length' => 'Tamanho da senha invádio'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->updatePassword($id, $request->get('password'));

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

    /**
     * @return mixed
     */
    public function authenticated()
    {
        $user = \Auth::guard('api')->user();
        return $this->service->authenticated($user->id, $user->role);
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

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|min:4',
            'role' => 'required'
        ], [
            'name.required' => 'Nome do usuário é obrigatório',
            'name.length' => 'Nome deve conter no minimo 4 caracteres',
            'role.required' => 'Nível de usuário é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'title' => 'Erro',
                'status' => 'error',
                'message' => $validator->errors()->unique()
            ], 406);
        }

        $result = $this->service->update($id, $request->all());

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Usuario atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }
}
