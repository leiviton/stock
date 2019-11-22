<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StatusPedidoRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface StatusPedidoRepository extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function findById($data):array;
}
