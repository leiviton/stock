<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\NotaFiscalPresenter;
use Stock\Models\NotaFiscal;

/**
 * Class NotaFiscalRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class NotaFiscalRepositoryEloquent extends BaseRepository implements NotaFiscalRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NotaFiscal::class;
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
        return NotaFiscalPresenter::class;
    }
}
