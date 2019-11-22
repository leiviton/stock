<?php

namespace Stock\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\StatusPedidoPresenter;
use Stock\Repositories\StatusPedidoRepository;
use Stock\Models\StatusPedido;
use Stock\Validators\StatusPedidoValidator;

/**
 * Class StatusPedidoRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class StatusPedidoRepositoryEloquent extends BaseRepository implements StatusPedidoRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatusPedido::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return StatusPedidoPresenter::class;
    }

    /**
     * Find data by between values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereBetween($field, array $values, $columns = ['*'])
    {
        // TODO: Implement findWhereBetween() method.
    }

    /**
     * @param $data
     * @return mixed
     */
    public function findById($data): array
    {
        $result = $this->model->where('pedido', $data['pedido'])->where('depositante',$data['depositante'])->first();

        if ($result) {
            return $this->parserResult($result);
        }

        return $result;
    }
}
