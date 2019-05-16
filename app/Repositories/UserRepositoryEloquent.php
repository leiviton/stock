<?php

namespace Stock\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\UserPresenter;
use Stock\Models\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;

    /**
     * @param $status
     * @return mixed
     */
    public function listUsers($status)
    {
        $result = $this->model->where('status',$status)->orderBy('name')
            ->paginate();
        if ($result){
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        return UserPresenter::class;
    }
}
