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
     * @param $user
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilter($data, $user,$cnpj,$lote = '');

    /**
     * @param $user
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderByRoads($user, $cnpj,$lote = '');

    /**
     * @param $chave
     * @return mixed
     */
    public function findByLogix($chave);

    /**
     * @param $data
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilterData($data, $cnpj, $lote = '');


    /**
     * @param $data
     * @return mixed
     */
    public function getQueryAdmin($data);


    /**
     * @param $data
     * @return mixed
     */
    public function getQueryUser($data);

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor);
}
