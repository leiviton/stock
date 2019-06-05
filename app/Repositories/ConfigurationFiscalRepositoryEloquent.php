<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\ConfigurationFiscalPresenter;
use Stock\Repositories\ConfigurationFiscalRepository;
use Stock\Models\ConfigurationFiscal;

/**
 * Class ConfigurationFiscalRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class ConfigurationFiscalRepositoryEloquent extends BaseRepository implements ConfigurationFiscalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ConfigurationFiscal::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
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
        return ConfigurationFiscalPresenter::class;
    }

}
