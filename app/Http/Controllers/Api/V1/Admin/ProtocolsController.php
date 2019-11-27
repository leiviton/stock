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
use Stock\Services\ProtocolService;

class ProtocolsController extends Controller
{
    /**
     * @var ProtocolService
     */
    private $service;

    /**
     * CompaniesController constructor.
     * @param ProtocolService $service
     */
    public function __construct(ProtocolService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->service->getProtocols($request->get('cnpj'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProtocols($id)
    {
        return $this->service->getProtocols($id);
    }
}
