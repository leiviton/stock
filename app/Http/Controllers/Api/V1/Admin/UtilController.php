<?php

namespace Stock\Http\Controllers\Api\V1\Admin;

use ApiWebSac\Mail\InvoiceOrder;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Stock\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Stock\Jobs\NotifyUserExport;
use Stock\Mail\IntegrationAprov;
use Stock\Mail\IntegrationEmail;
use Stock\Mail\IntegrationLogix;
use Stock\Mail\IntegrationPedAprov;
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
     * @throws \Exception
     */
    public function reports(Request $request)
    {
        set_time_limit(0);


        $start = new DateTime($this->invertDate($request->get('start')));
        $end = new DateTime($this->invertDate($request->get('end')));

        if ($start > $end) {
            return response()->json(['title' => 'Erro', 'status' => 'error', 'message' => 'Data final maior que data inicial'], 400);
        }

        $dataEnd = $this->clear($this->invertDate((string)$request->get('end')));

        $dataStart = $this->clear($this->invertDate((string)$request->get('start')));

        $cnpj = substr($this->clear($request->get('cnpj')), 1, 8);

        $difal = $request->get('difal');

        if ($request->get('type') == 'avulso') {
            $name = 'AV_' . $dataStart;
            if ($cnpj == '') {
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,PROTOCOLO,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,MARKUP,DIFAL,VALOR_DESTINO,VFCP,TOTAL_A_PAGAR,MSG_NF FROM dbo.relfin01(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                } else {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                }
            } else {
                $cnpj = $cnpj . '%';
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select("SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,CASPIAN,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,VALOR_DESTINO,VFCP,MSG_NF FROM dbo.relfin01(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC", [$dataStart, $dataEnd, $cnpj]);
                } else {
                    $query = DB::connection('sqlsrvcomprovei')->select("SELECT * FROM dbo.relfin01(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC", [$dataStart, $dataEnd, $cnpj]);
                }
            }
        } else {
            $name = 'GN_' . $dataStart;
            if ($cnpj == '') {
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,CASPIAN,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,VALOR_DESTINO,VFCP,MSG_NF FROM dbo.relfin02(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                } else {

                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                }
            } else {
                $cnpj = $cnpj . '%';
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,CASPIAN,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,VALOR_DESTINO,VFCP,MSG_NF FROM dbo.relfin02(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC', [$dataStart, $dataEnd, $cnpj]);
                } else {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC', [$dataStart, $dataEnd, $cnpj]);
                }
            }
        }

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
     * @throws \Exception
     */
    public function getGnre(Request $request)
    {
        set_time_limit(0);

        $start = new DateTime($this->invertDate($request->get('start')));
        $end = new DateTime($this->invertDate($request->get('end')));

        if ($start > $end) {
            return response()->json(['title' => 'Erro', 'status' => 'error', 'message' => 'Data final maior que data inicial'], 400);
        }
        $dataEnd = $this->clear($this->invertDate((string)$request->get('end')));

        $dataStart = $this->clear($this->invertDate((string)$request->get('start')));

        $cnpj = substr($this->clear($request->get('cnpj')), 1, 8);

        $difal = $request->get('difal');

        if ($request->get('type') == 'avulso') {
            $name = 'AV_' . $dataStart;
            if ($cnpj == '') {
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,PROTOCOLO,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,MARKUP,DIFAL,VALOR_DESTINO,VFCP,TOTAL_A_PAGAR,MSG_NF FROM dbo.relfin01(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                } else {
                    $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin01(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
                }
            } else {
                $cnpj = $cnpj . '%';
                if ($difal == 'nao') {
                    $query = DB::connection('sqlsrvcomprovei')->select("SELECT EMPRESA,NF_DE_SAIDA,SERIE,ITEM_NF,CST,CODIGO,DESC_PROD,EMISSAO_NF,ID_CLIENTE,CNPJ,CLIENTE,DESTINATARIO,PROTOCOLO,TRANSPORTADORA,SEFAZ,UF,VALOR_DA_NF,ALIQUOTA_INTERESTADUAL,ALIQUOTA_INTERNA,FECP,MARKUP,DIFAL,VALOR_DESTINO,VFCP,TOTAL_A_PAGAR,MSG_NF FROM dbo.relfin01(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC", [$dataStart, $dataEnd, $cnpj]);
                } else {
                    $query = DB::connection('sqlsrvcomprovei')->select("SELECT * FROM dbo.relfin01(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE,DATA_LANCTO ASC", [$dataStart, $dataEnd, $cnpj]);
                }
            }
        } else {
            $name = 'GN_' . $dataStart;
            if ($cnpj == '') {
                $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?) ORDER BY CLIENTE ASC', [$dataStart, $dataEnd]);
            } else {
                $cnpj = $cnpj . '%';
                $query = DB::connection('sqlsrvcomprovei')->select('SELECT * FROM dbo.relfin02(?,?) WHERE CNPJ LIKE ? ORDER BY CLIENTE ASC', [$dataStart, $dataEnd, $cnpj]);

            }
        }

        return $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function getReportCompras(Request $request)
    {

        $start1 = new DateTime($this->invertDate($request->get('start')));
        $end1 = new DateTime($this->invertDate($request->get('end')));

        if ($start1 > $end1) {
            return response()->json(['title' => 'Erro', 'status' => 'error', 'message' => 'Data final maior que data inicial'], 400);
        }

        $start = $this->clear($this->invertDate($request->get('start')));

        $end = $this->clear($this->invertDate($request->get('end')));

        $dataPesquisa = $request->get('dataPesquisa');

        $filial = $request->get('filial');

        $cnpj = substr($this->clear($request->get('cnpj')), 1, 8);

        if ($filial == 'todos') {
            if ($cnpj == '') {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->orderBy('NOME_FOR', 'ASC')->get();
            } else {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->orderBy('NOME_FOR', 'ASC')->where('CNPJ', 'like', "$cnpj%")->get();
            }
        } else {
            if ($cnpj == '') {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->where('FILIAL', $filial)->orderBy('NOME_FOR', 'ASC')->get();
            } else {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->where('FILIAL', $filial)->where('CNPJ', 'like', "$cnpj%")->orderBy('NOME_FOR', 'ASC')->get();
            }
        }

        $query = json_decode(json_encode($query), true);

        for ($i = 0; $i < count($query); $i++) {
            $query[$i]['DATA_EMISSAO'] = substr($query[$i]['DATA_EMISSAO'], 6, 2) . '/' . substr($query[$i]['DATA_EMISSAO'], 4, 2) . '/' . substr($query[$i]['DATA_EMISSAO'], 0, 4);
            $query[$i]['DATA_LANCTO'] = substr($query[$i]['DATA_LANCTO'], 6, 2) . '/' . substr($query[$i]['DATA_LANCTO'], 4, 2) . '/' . substr($query[$i]['DATA_LANCTO'], 0, 4);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function exportCompras(Request $request)
    {

        $start = new DateTime($this->invertDate($request->get('start')));
        $end = new DateTime($this->invertDate($request->get('end')));

        if ($start > $end) {
            return response()->json(['title' => 'Erro', 'status' => 'error', 'message' => 'Data final maior que data inicial'], 400);
        }

        $start = $this->clear($this->invertDate($request->get('start')));

        $end = $this->clear($this->invertDate($request->get('end')));

        $dataPesquisa = $request->get('dataPesquisa');

        $filial = $request->get('filial');

        $cnpj = substr($this->clear($request->get('cnpj')), 1, 8);

        if ($filial == 'todos') {
            if ($cnpj == '') {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->orderBy('NOME_FOR', 'ASC')->get();
            } else {

                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->orderBy('NOME_FOR', 'ASC')->where('CNPJ', 'like', "$cnpj%")->get();
            }
        } else {
            if ($cnpj == '') {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->where('FILIAL', $filial)->orderBy('NOME_FOR', 'ASC')->get();
            } else {
                $query = DB::connection('sqlsrvcomprovei')->table('dbo.RELNFCC')->whereBetween($dataPesquisa, [$start, $end])->where('FILIAL', $filial)->where('CNPJ', 'like', "$cnpj%")->orderBy('NOME_FOR', 'ASC')->get();
            }
        }
        $name = 'CC_' . $start;
        $query = json_decode(json_encode($query), true);

        //strrev

        for ($i = 0; $i < count($query); $i++) {
            $query[$i]['DATA_EMISSAO'] = substr($query[$i]['DATA_EMISSAO'], 6, 2) . '/' . substr($query[$i]['DATA_EMISSAO'], 4, 2) . '/' . substr($query[$i]['DATA_EMISSAO'], 0, 4);
            $query[$i]['DATA_LANCTO'] = substr($query[$i]['DATA_LANCTO'], 6, 2) . '/' . substr($query[$i]['DATA_LANCTO'], 4, 2) . '/' . substr($query[$i]['DATA_LANCTO'], 0, 4);
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getClient()
    {
        $result = DB::connection('sqlsrvcomprovei')->table('dbo.CADCLIFOR')->paginate();

        return $result;
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

    public function sendNotificationSolicitation()
    {
        $arraySolicitationNumber = DB::connection('sqlsrvcomprovei')
            ->select("SELECT	RTRIM(SC7.C7_NUM) num_pedido,
		RTRIM(SC7.C7_NUMSC) num_solicit,
		RTRIM(SC1.C1_NOMESOL) solicitante,
		RIGHT(SC7.C7_DATPRF,2)+'/'+SUBSTRING(SC7.C7_DATPRF,5,2)+'/'+LEFT(SC7.C7_DATPRF,4) AS data_entrega,
		RTRIM(SC1.C1_EMAIL) email
FROM SC7010 SC7
	LEFT JOIN SC1010 SC1 ON (SC1.D_E_L_E_T_='' AND SC1.C1_FILIAL = SC7.C7_FILIAL AND SC1.C1_NUM = SC7.C7_NUMSC)
WHERE C7_RESIDUO ='' AND C7_CONTRA ='' AND C7_CONAPRO <> 'B' AND SC7.C7_NUMSC <> '' AND SC7.C7_EMISSAO >= '20200216' 
AND C7_XENVAPR <> '1'
GROUP BY SC7.C7_NUM, SC7.C7_NUMSC, SC1.C1_NOMESOL, SC1.C1_EMAIL, SC7.C7_XENVEML, SC7.C7_DATPRF, C7_XENVAPR");


            if (count($arraySolicitationNumber) > 0) {
                for ($j = 0; $j < sizeof($arraySolicitationNumber); $j++) {
                        Mail::queue(new IntegrationPedAprov($arraySolicitationNumber[$j]->email, $arraySolicitationNumber[$j], $arraySolicitationNumber[$j]->num_pedido));
                        DB::connection('sqlsrvcomprovei')->update("UPDATE SC7010 SET C7_XENVAPR = '1' WHERE C7_NUM = ?", [$arraySolicitationNumber[$j]->num_pedido]);
                }
            }else{
                return response()->json(['message' => 'Sem pedidos nessa data email']);
            }

        //dd($arraySolicitationNumber);
    }
}
