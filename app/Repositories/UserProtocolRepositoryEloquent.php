<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Repositories\UserProtocolRepository;
use Stock\Models\UserProtocol;
use Stock\Validators\UserProtocolValidator;

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
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
