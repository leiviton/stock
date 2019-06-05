<?php

namespace Stock\Http\Controllers\Api\V1\Admin;

use GuzzleHttp\Client;
use Stock\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stock\Services\NFeService;

class UtilController extends Controller
{
    /**
     * @var NFeService
     */
    private $NFeService;

    /**
     * UtilController constructor.
     * @param NFeService $NFeService
     */
    public function __construct(NFeService $NFeService)
    {
        $this->NFeService = $NFeService;
    }

    /**
     * @param $cnpj
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCnpj($cnpj)
    {
        $client = new Client();
        $url = "http://receitaws.com.br/v1/cnpj/$cnpj";
        return $client->get($url);
    }

    /**
     * @param $cep
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCep($cep)
    {
        $client = new Client();
        $url = "https://viacep.com.br/ws/$cep/json/";
        return $client->get($url);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProtocols()
    {
        $user = \Auth::guard()->user();

        if ($user->role == 'user_company') {
            $cnpj = $this->limpaCPF_CNPJ($user->company->cnpj);
            $result = DB::connection('sqlsrv')->table('logix.wms_tip_estoque')->where('empresa_deposit', $cnpj)->get();
        } else {
            $result = DB::connection('sqlsrv')->table('logix.wms_tip_estoque')->get();
        }

        return response()->json(['data' => $result]);
    }

    public function emitirNfe() {
        return $this->NFeService->emitirNfe();
    }

    public function consultaProtocolo($recibo) {
        return $this->NFeService->consultaProtocolo($recibo);
    }

    /**
     * @return string
     */
    public function emitirDanfe() {
        return $this->NFeService->geraDanfe();
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
