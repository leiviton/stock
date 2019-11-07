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
use Stock\Services\ExtensionsService;
use Stock\Services\NewsService;

class ExtensionsController extends Controller
{
    /**
     * @var ExtensionsService
     */
    private $service;

    /**
     * ExtensionsController constructor.
     * @param ExtensionsService $service
     */
    public function __construct(ExtensionsService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return $this->service->getNews();
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
            return response()->json(['message' => 'Cadastro realizado com sucesso', 'status' => 'success',
                'title' => 'Sucesso'], 201);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error',
                'title' => 'Erro'], 400);
        }
    }

    public function edit($id)
    {
        return $this->service->getId($id);
    }

    public function upload(Request $request)
    {
        $nameFile = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->image->storeAs('extensions', $nameFile, 'public');
            if (!$upload) {
                return response()->json(['message' => 'Verifique o arquivo enviado', 'status' => 'error','title' => 'Erro'], 400);
            } else {
                return response()->json(['file' => $nameFile]);
            }
        }else{
            return response()->json(['message' => 'Verifique o arquivo enviado 1', 'status' => 'error','title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $result = $this->service->update($request->all(), $id);

        if ($result['status'] == 'success') {
            return response()->json(['message' => 'Ramal atualizado com sucesso', 'status' => 'success', 'title' => 'Sucesso'], 200);
        } else if ($result['status'] == 'error') {
            return response()->json(['message' => $result['message'], 'status' => 'error', 'title' => 'Erro'], 400);
        }
    }

}
