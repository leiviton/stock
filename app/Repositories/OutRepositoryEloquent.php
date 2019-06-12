<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\OutPresenter;
use Stock\Models\Out;
use Stock\Validators\OutValidator;

/**
 * Class OutRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class OutRepositoryEloquent extends BaseRepository implements OutRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Out::class;
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
        return OutPresenter::class;
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
        $order[0] = $order[0] ?? 'data_envio';
        $order[1] = $order[1] ?? 'asc';
        //dd($lote);
        if ($lote == '') {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                        ->where('tipo_estoque', $lote)
                        ->groupBy('tipo_estoque')
                        ->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('tipo_estoque', $lote)
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if($data['field'] == 'data_envio') {
                                return $query->where($data['field'],$data['value']);
                            }else if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        //->groupBy('tipo_estoque')
                        ->paginate();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                        // ->groupBy('tipo_estoque')
                        ->get();
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
                        //->groupBy('tipo_estoque')
                        ->paginate();
                }
            }
        } else {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                        ->where('tipo_estoque', $lote)
                       // ->groupBy('tipo_estoque')
                        ->get();
                } else {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('tipo_estoque', $lote)
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        //->groupBy('tipo_estoque')
                        ->paginate();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])
                        ->where('depositante', $cnpj)
                       // ->groupBy('tipo_estoque')
                        ->get();
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
                        //->groupBy('tipo_estoque')
                        ->paginate();
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
    public function orderByOuts($user, $cnpj, $lote = '')
    {
        $dataEnd = new \DateTime();
        $order[0] = $order[0] ?? 'data_envio';
        $order[1] = $order[1] ?? 'asc';
        //dd($user->role);
        if ($lote != '') {
            if ($user->role == 'user_company') {
                $results = $this->model->orderBy($order[0], $order[1])
                    ->where('depositante', $cnpj)
                    //->sum('qtd_enviada')
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                        }
                        return $query;
                    })
                   // ->groupBy('tipo_estoque')
                    ->paginate();
            } else {
                $results = $this->model->orderBy($order[0], $order[1])
                    ->where('tipo_estoque', $lote)
                   // ->sum('qtd_enviada')
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd])->groupBy('tipo_estoque');
                        }
                        return $query;
                    })
                    //->groupBy('tipo_estoque')
                    ->paginate();
            }
        } else {

            $results = $this->model->orderBy($order[0], $order[1])
                ->where(function ($query) use ($dataEnd,$cnpj) {
                    if ($dataEnd) {
                        return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd])
                            ->where('depositante', $cnpj);
                    }
                    return $query;
                })
                //->groupBy('tipo_estoque')
                ->paginate();

        }
        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }
}
