<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OutRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface OutRepository extends RepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function orderFilter($data);

    /**
     * @return mixed
     */
    public function orderByOuts();
}
