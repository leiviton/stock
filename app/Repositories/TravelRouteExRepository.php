<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TravelRouteRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface TravelRouteExRepository extends RepositoryInterface
{
    /**
     * @param $dataStart
     * @param $dataEnd
     * @return mixed
     */
    public function getQueryUser($dataStart, $dataEnd);

    /**
     * @param $now
     * @return mixed
     */
    public function getAgent($now);
}
