<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\NotaFiscalItemPresenter;
use Stock\Models\NotaFiscalItem;

/**
 * Class NotaFiscalItemRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class NotaFiscalItemRepositoryEloquent extends BaseRepository implements NotaFiscalItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NotaFiscalItem::class;
    }


    /**
     * Boot up the repository, pushing criteria
     *
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
        return NotaFiscalItemPresenter::class;
    }
}
