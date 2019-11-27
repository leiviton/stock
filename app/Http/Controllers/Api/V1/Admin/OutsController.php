<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace Stock\Http\Controllers\Api\V1\Admin;

use Illuminate\Support\Facades\DB;
use Stock\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stock\Services\OutService;

class OutsController extends Controller
{
    /**
     * @var OutService
     */
    private $service;
    /**
     * OutsController constructor.
     * @param OutService $service
     */
    public function __construct(OutService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $id
     * @param $lote
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function index($id,Request $request)
    {
        /*$result = DB::connection('sqlsrvyouvita')->table('logix.status_sc')->where('depositante','000251699000162')->get();
        dd($result[0]);
        */
        $lote = $request->get('protocol') ? $request->get('protocol') : '';
        return $this->service->getOuts($request->all(),$id,$lote);
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function filterData($id, Request $request)
    {
        if($this->service->diffDays($request->get('start'),$request->get('end')) > 31) {
            return response()->json([ 'title' => 'Erro','status' => 'error', 'message' => 'Intervalo de datas não pode ser maior que 31 dias'],406);
        }else if($this->service->diffDays($request->get('start'),$request->get('end')) < 0) {
            return response()->json([ 'title' => 'Erro','status' => 'error', 'message' => 'Data final maior que data inicial'],406);

        }
        $lote = $request->get('protocolo') ? $request->get('protocolo') : '';
        return $this->service->getOutsData($request->all(),$id,$lote);
    }

    /**
     * @return mixed
     */
    public function getAll($id,Request $request)
    {
        /*$result = DB::connection('sqlsrv')->table('logix.stocks')->where('depositante','000251699000162')->get();
        dd($result[0]);*/
        $lote = $request->get('protocolo') != '' ? $request->get('protocolo') : '';
        //dd($lote);
        return $this->service->getAll($id,$lote);
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

        return response()->json(['message' => 'Arquivo gerado com sucesso', 'link' => env('APP_URL').'/storage/excel/outs/'.$result.'.xlsx'],200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->service->create($data);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 201);
        } else {
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
