<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 27/05/2019
 * Time: 15:44
 */

namespace Stock\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use Stock\Http\Controllers\Controller;
use Stock\Services\NFeService;

class NotaFiscalController extends Controller
{
    /**
     * @var NFeService
     */
    private $service;

    /**
     * NotaFiscalController constructor.
     * @param NFeService $service
     */
    public function __construct(NFeService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $status = $request->get('status');

        return $this->service->listNfe($status);
    }
}