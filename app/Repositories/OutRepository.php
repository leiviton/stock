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
    public function orderByOuts($user, $cnpj,$lote = '');

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
    public function getQueryUser($data);

    /**
     * @param $data
     * @return mixed
     */
    public function getQueryAdmin($data);
}
