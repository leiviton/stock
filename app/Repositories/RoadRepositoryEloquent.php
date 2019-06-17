<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
     * @param $user
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilter($data, $user, $cnpj, $lote = '')
    {
        $order[0] = $order[0] ?? 'data_recebimento';
        $order[1] = $order[1] ?? 'asc';
        if ($lote == '') {
            if ($user->role == 'user_company') {
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
                        ->paginate();
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
                        ->paginate();
                }
            }
        } else {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $cnpj)->where('tipo_estoque', $lote)->get();
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
                        ->paginate();
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
    public function orderByRoads($user, $cnpj, $lote = '')
    {
        $dataEnd = new \DateTime();
        $order[0] = $order[0] ?? 'data_recebimento';
        $order[1] = $order[1] ?? 'asc';
        //dd($user->role);
        if ($lote != '') {
            if ($user->role == 'user_company') {
                $results = $this->model->orderBy($order[0], $order[1])
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                        }
                        return $query;
                    })
                    ->paginate();
            } else {
                $results = $this->model->orderBy($order[0], $order[1])
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

            $results = $this->model->orderBy($order[0], $order[1])
                ->where('depositante', $cnpj)
                //->selectRaw('data_recebimento,tipo_estoque,desc_tipo_estoque,cnpj_emissor_nfe,razao_social_fornecedor,codigo_produto,desc_produto,unidade_medida,lote,data_validade,serie_nf,tipo_nf,desc_restricao,serie,peca,sum(qtd_fiscal) as qtd_fiscal,sum(qtd_recebida) as qtd_recebida')
                ->where(function ($query) use ($dataEnd) {
                    if ($dataEnd) {
                        return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd])->groupBy(['lote','data_recebimento']);
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

    /**
     * @param $chave
     * @return mixed
     */
    public function findByLogix($chave) {

        $result = $this->model->findWhere(['chave_logix' => $chave])->first() ?? null;

        Log::info('Registro entradas: ' . $result);

        return $result;
    }
}
