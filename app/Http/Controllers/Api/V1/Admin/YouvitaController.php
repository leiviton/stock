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
use Stock\Services\YouvitaService;

class YouvitaController extends Controller
{
    /**
     * @var YouvitaService
     */
    private $service;

    /**
     * YouvitaController constructor.
     * @param YouvitaService $service
     */
    public function __construct(YouvitaService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStock($id)
    {
        return $this->service->getStock($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStatus(Request $request)
    {
        $data = $request->all();
        return $this->service->getStatus($data);
    }
}