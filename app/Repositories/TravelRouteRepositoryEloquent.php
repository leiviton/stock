<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Repositories\TravelRouteRepository;
use Stock\Models\TravelRoute;
use Stock\Validators\TravelRouteValidator;

/**
 * Class TravelRouteRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class TravelRouteRepositoryEloquent extends BaseRepository implements TravelRouteRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TravelRoute::class;
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
     * @param $dataStart
     * @param $dataEnd
     * @return mixed
     */
    public function getQueryUser($dataStart, $dataEnd)
    {
        $query = $this->model->where(function ($query) use ($dataStart,$dataEnd) {
            return $query->whereRaw('DATA_ROTA BETWEEN ? AND ?',
                [$dataStart, $dataEnd]);
        })->get();

        return $query;
    }
    
}
