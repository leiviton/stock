<?php

namespace Stock\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Models\Protocol;
use Stock\Presenters\ProtocolPresenter;

/**
 * Class ProtocolRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class ProtocolRepositoryEloquent extends BaseRepository implements ProtocolRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Protocol::class;
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
     * @param $cnpj
     * @return mixed
     */
    public function getProtocolsCompany($cnpj)
    {
        $result = $this->model->where('empresa_deposit',$cnpj)->where('sit_registro',1)->orderBy('des_tip_estoque','asc')->get();

        if ($result){
            return $this->parserResult($result);
        }

        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return ProtocolPresenter::class;
    }
}
