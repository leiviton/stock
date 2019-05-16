<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProtocolRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface ProtocolRepository extends RepositoryInterface
{
    /**
     * @param $cnpj
     * @return mixed
     */
    public function getProtocolsCompany($cnpj);
}
