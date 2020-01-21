<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\BankIdeaPresenter;
use Stock\Repositories\BankIdeaRepository;
use Stock\Models\BankIdea;
use Stock\Validators\BankIdeaValidator;

/**
 * Class BankIdeaRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class BankIdeaRepositoryEloquent extends BaseRepository implements BankIdeaRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BankIdea::class;
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
        return BankIdeaPresenter::class;
    }
}
