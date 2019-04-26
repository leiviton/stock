<?php

namespace Stock\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace Stock\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param $status
     * @return mixed
     */
    public function listUsers($status);
}
