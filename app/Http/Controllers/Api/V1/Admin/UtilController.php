<?php

namespace Stock\Http\Controllers\Api\V1\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Stock\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stock\Jobs\NotifyUserExport;
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
        set_time_limit(0);

        $dataEnd = $this->clear($this->invertDate((string)$request->get('end')));

        $dataStart = $this->clear($this->invertDate((string)$request->get('start')));

        if ($request->get('type') == 'avulso') {
            $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?) ORDER BY ? ASC',[$dataStart, $dataEnd,'CLIENTE']);
            $name = 'AV_' . $dataStart;
        } else {
            $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?) ORDER BY ? ASC',[$dataStart, $dataEnd,'CLIENTE']);
            $name = 'GN_' . $dataStart;
        }

        //$user = \Auth::user();

        $query = json_decode(json_encode($query), true);

        Excel::create($name, function ($excel) use ($query) {
            $excel->sheet('Sheet 1', function ($sheet) use ($query) {
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

        $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?)', [$dataStart, $dataEnd]);

        $query = json_decode(json_encode($query), true);

        return $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getReportCompras(Request $request)
    {
        $start = $this->clear($this->invertDate($request->get('start')));

        $end = $this->clear($this->invertDate($request->get('end')));

        $dataPesquisa = $request->get('dataPesquisa');

        $filial = $request->get('filial');

        if($filial == 'todos')
        {
            $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa,[$start,$end])->orderBy('NOME_FOR','ASC')->get();
        }else {
            $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa,[$start,$end])->where('FILIAL',$filial)->orderBy('NOME_FOR','ASC')->get();
        }

        $query = json_decode(json_encode($query), true);

        for($i = 0; $i < count($query) ; $i++) {
            /*$query[$i]['DATA_EMISSAO'] = strrev($query[$i]['DATA_EMISSAO']);
            $query[$i]['DATA_LANCTO'] = strrev($query[$i]['DATA_LANCTO']);*/

            $query[$i]['DATA_EMISSAO'] = substr($query[$i]['DATA_EMISSAO'],7,2).'/'.substr($query[$i]['DATA_EMISSAO'],4,2).'/'.substr($query[$i]['DATA_EMISSAO'],0,4);
            $query[$i]['DATA_LANCTO'] = substr($query[$i]['DATA_LANCTO'],7,2).'/'.substr($query[$i]['DATA_LANCTO'],4,2).'/'.substr($query[$i]['DATA_LANCTO'],0,4);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportCompras(Request $request)
    {
        $start = $this->clear($this->invertDate($request->get('start')));

        $end = $this->clear($this->invertDate($request->get('end')));

        $dataPesquisa = $request->get('dataPesquisa');

        $filial = $request->get('filial');

        if($filial == 'todos')
        {
            $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa,[$start,$end])->orderBy('NOME_FOR','ASC')->get();
        }else {
            $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa,[$start,$end])->where('FILIAL',$filial)->orderBy('NOME_FOR','ASC')->get();
        }
        $name = 'CC_' . $start;
        $query = json_decode(json_encode($query), true);

        //strrev

        for($i = 0; $i < count($query) ; $i++) {
            $query[$i]['DATA_EMISSAO'] = strrev($query[$i]['DATA_EMISSAO']);
            $query[$i]['DATA_LANCTO'] = strrev($query[$i]['DATA_LANCTO']);

            $query[$i]['DATA_EMISSAO'] = substr($query[$i]['DATA_EMISSAO'],0,2).'/'.substr($query[$i]['DATA_EMISSAO'],2,2).substr($query[$i]['DATA_EMISSAO'],4,4);
            $query[$i]['DATA_LANCTO'] = substr($query[$i]['DATA_LANCTO'],0,2).'/'.substr($query[$i]['DATA_LANCTO'],2,2).substr($query[$i]['DATA_LANCTO'],4,4);
        }

        Excel::create($name, function ($excel) use ($query) {
            $excel->sheet('Sheet 1', function ($sheet) use ($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/finance');

        return response()->json(['link' => env('APP_URL') . '/storage/excel/finance/' . (string)$name . '.xlsx']);
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

    public function emitirNfe()
    {
        return $this->NFeService->emitirNfe();
    }

    public function consultaProtocolo($recibo)
    {
        return $this->NFeService->consultaProtocolo($recibo);
    }

    /**
     * @return string
     */
    public function emitirDanfe()
    {
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
