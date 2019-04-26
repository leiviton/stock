<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StockRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface StockRepository extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function orderFilter($data);

    /**
     * @return mixed
     * @throws \Exception
     */
    public function orderByStocks();
}
