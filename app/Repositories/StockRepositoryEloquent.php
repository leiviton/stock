<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\StockPresenter;
use Stock\Repositories\StockRepository;
use Stock\Models\Stock;
use Stock\Validators\StockValidator;

/**
 * Class StockRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class StockRepositoryEloquent extends BaseRepository implements StockRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stock::class;
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
        return StockPresenter::class;
    }

    /**
     * @param $data
     * @param $user
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilter($data, $user, $cnpj, $lote = '')
    {
        $order[0] = $order[0] ?? 'data_validade';
        $order[1] = $order[1] ?? 'desc';
        if ($lote == '') {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $user->company->cnpj)->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $user->company->cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->get();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $cnpj)->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->get();
                }
            }
        } else {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $user->company->cnpj)->where('tipo_estoque', $lote)->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('tipo_estoque', $lote)
                        ->where('depositante', $user->company->cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->get();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $cnpj)->where('tipo_estoque', $lote)->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                        ->where('tipo_estoque', $lote)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->get();
                }
            }
        }

        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * @param $user
     * @param $cnpj
     * @param string $lote
     * @return mixed
     * @throws \Exception
     */
    public function orderByStocks($user, $cnpj, $lote = '')
    {
        $dataEnd = new \DateTime();
        //dd($user->role);
        if ($lote != '') {
            if ($user->role == 'user_company') {
                $results = $this->model
                    ->where('depositante', $user->company->cnpj)
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                        }
                        return $query;
                    })
                    ->paginate();
            } else {
                $results = $this->model
                    ->where('tipo_estoque', $lote)
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                        }
                        return $query;
                    })
                    ->paginate();
            }
        } else {

            $results = $this->model
                ->where('depositante', $cnpj)
                ->where(function ($query) use ($dataEnd) {
                    if ($dataEnd) {
                        return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                    }
                    return $query;
                })
                ->paginate();

        }
        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }
}
