<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\RoadPresenter;
use Stock\Repositories\RoadRepository;
use Stock\Models\Road;
use Stock\Validators\RoadValidator;

/**
 * Class RoadRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class RoadRepositoryEloquent extends BaseRepository implements RoadRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Road::class;
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
        return RoadPresenter::class;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function orderFilter($data)
    {
        $order[0] = $order[0] ?? 'data_validade';
        $order[1] = $order[1] ?? 'desc';

        if($data['value'] == ''){
            $results = $this->model
                ->orderBy($order[0],$order[1])->get();
        }else{
            $results = $this->model
                ->orderBy($order[0],$order[1])
                ->where(function ($query) use ($data) {
                    if ($data){
                        return $query->where($data['field'],'like','%'. $data['value'].'%');
                    }
                    return $query;
                })
                ->paginate();
        }

        if ($results){
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function orderByRoads()
    {
        $dataEnd = new \DateTime();
        $results = $this->model
            ->where(function ($query) use ($dataEnd) {
                if ($dataEnd) {
                    return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                }
                return $query;
            })
            ->paginate();

        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }
}
