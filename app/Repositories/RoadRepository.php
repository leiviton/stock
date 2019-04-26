<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoadRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface RoadRepository extends RepositoryInterface
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
    public function orderByRoads();
}
