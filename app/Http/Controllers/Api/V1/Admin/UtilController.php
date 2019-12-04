<?php

namespace Stock\Http\Controllers\Api\V1\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Stock\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stock\Services\NFeService;

class UtilController extends Controller
{
    use UtilTrait;
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
     * @param Request $request
     * @return string
     */
    public function reports(Request $request)
    {
        $dataEnd = $this->clear($this->invertDate((string)$request->get('end')));

        $dataStart = $this->clear($this->invertDate((string)$request->get('start')));

        if($request->get('type') == 'avulso')
        {
            $query =  DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?)',[$dataStart,$dataEnd]);
            $name = 'AV_' . $dataStart;
        } else {
            $query =  DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?)',[$dataStart,$dataEnd]);
            $name = 'GN_' . $dataStart;
        }

        $query= json_decode( json_encode($query), true);

        Excel::create($name, function($excel) use($query) {
            $excel->sheet('Sheet 1', function($sheet) use($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/finance');

        return response()->json(['link' => env('APP_URL') . '/storage/excel/finance/' . (string)$name . '.xlsx']);
    }

    /**
     * @return array|mixed
     */
    public function getGnre()
    {
        $dataEnd = $this->clear($this->invertDate((string)date('d/m/Y')));

        $dataStart = $this->clear($this->invertDate((string)date('d/m/Y')));

        $query =  DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?)',[$dataStart,$dataEnd]);

        $query = json_decode( json_encode($query), true);

        return $query;
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

    /**
     * @param $valor
     * @return mixed|string
     */
    public function clear($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    /**
     * @param $date
     * @return string
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
}
