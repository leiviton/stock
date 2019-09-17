<?php


namespace Stock\Http\Controllers\Api\V1\Admin;

use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stock\Http\Controllers\Controller;
use Stock\Repositories\TravelRouteExRepository;
use Stock\Repositories\TravelRouteRepository;

class ComproveiController extends Controller
{
    /**
     * @var TravelRouteRepository
     */
    private $travelRouteRepository;
    /**
     * @var TravelRouteExRepository
     */
    private $travelRouteExRepository;

    /**
     * ComproveiController constructor.
     * @param TravelRouteRepository $travelRouteRepository
     * @param TravelRouteExRepository $travelRouteExRepository
     */
    public function __construct(TravelRouteRepository $travelRouteRepository,
                                TravelRouteExRepository $travelRouteExRepository)
    {
        $this->travelRouteRepository = $travelRouteRepository;
        $this->travelRouteExRepository = $travelRouteExRepository;
    }

    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $dataEnd = $this->clear($this->invertDate((string)$request->get('end')));

        $dataStart = $this->clear($this->invertDate((string)$request->get('start')));

        $type = $request->get('type');

        if ($type == 'agente') {
            $query = $this->travelRouteExRepository->getQueryUser($dataStart, $dataEnd);
            $name = 'AG_' . $dataStart;
        } else {
            $query = $this->travelRouteRepository->getQueryUser($dataStart, $dataEnd);
            $name = 'SP_' . $dataStart;
        }


        Excel::create($name, function ($excel) use ($query) {
            $excel->sheet('Sheet 1', function ($sheet) use ($query) {
                $sheet->fromArray($query);
            });
        })->store('xlsx', public_path() . '/storage/excel/comprovei');

        return response()->json(['link' => env('APP_URL') . '/storage/excel/comprovei/' . (string)$name . '.xlsx', 200]);
    }

    public function getAgents()
    {
        $now = $this->clear(date_format(new \DateTime(),'Y-m-d'));

        $query = $this->travelRouteExRepository->getAgent($now);

        return $query;
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
}
