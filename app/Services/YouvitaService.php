<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 17/04/2019
 * Time: 16:03
 */

namespace Stock\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stock\Repositories\ExtensionRepository;
use Stock\Repositories\StatusPedidoRepository;
use Stock\Repositories\StockRepository;

class YouvitaService
{
    /**
     * @var StatusPedidoRepository
     */
    private $repository;
    /**
     * @var StockRepository
     */
    private $stockRepository;

    /**
     * YouvitaService constructor.
     * @param StatusPedidoRepository $repository
     * @param StockRepository $stockRepository
     */
    public function __construct(StatusPedidoRepository $repository, StockRepository $stockRepository)
    {
        $this->repository = $repository;
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStatus($data)
    {
        return $this->repository->skipPresenter(false)->findById($data);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getStock($id)
    {
        return $this->stockRepository->skipPresenter(false)->findById($id);
    }

}
