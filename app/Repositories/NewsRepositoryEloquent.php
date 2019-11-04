<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\NewsPresenter;
use Stock\Repositories\NewsRepository;
use Stock\Models\News;
use Stock\Validators\NewsValidator;

/**
 * Class NewsRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return NewsPresenter::class;
    }

}
