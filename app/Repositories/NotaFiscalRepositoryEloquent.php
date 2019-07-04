<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\NotaFiscalPresenter;
use Stock\Repositories\NotaFiscalRepository;
use Stock\Models\NotaFiscal;
use Stock\Validators\NotaFiscalValidator;

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
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return NotaFiscalPresenter::class;
    }
}
