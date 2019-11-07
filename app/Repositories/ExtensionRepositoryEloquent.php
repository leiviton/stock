<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Repositories\ExtensionRepository;
use Stock\Models\Extension;
use Stock\Validators\ExtensionValidator;

/**
 * Class ExtensionRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class ExtensionRepositoryEloquent extends BaseRepository implements ExtensionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Extension::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
