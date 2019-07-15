<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\UserProtocolPresenter;
use Stock\Models\UserProtocol;

/**
 * Class UserProtocolRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class UserProtocolRepositoryEloquent extends BaseRepository implements UserProtocolRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserProtocol::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return UserProtocolPresenter::class;
    }
}
