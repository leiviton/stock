<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StockRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface StockRepository extends RepositoryInterface {
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
    public function orderByStocks($user, $cnpj,$lote);

    /**
     * @param $id
     * @param $tipo
     * @return mixed
     */
    public function findById($id,$tipo);

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

}
