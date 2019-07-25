<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\StockPresenter;
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
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string|null
     */
    public function validator()
    {
        return StockValidator::class;
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
        $order[0] = $order[0] ?? 'data_atual';
        $order[1] = $order[1] ?? 'asc';
        if ($lote == '') {
            if ($user->role == 'user_company') {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $user->company->cnpj)->get();
                } else {
                    $results = $this->model
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,codigo_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_restricao')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque','asc')
                        ->orderBy('qtd_produto','asc')
                        ->get();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $cnpj)->get();
                } else {
                    $results = $this->model
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_restricao')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque','asc')
                        ->orderBy('qtd_produto','asc')
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
                        ->where('tipo_estoque', $lote)
                        ->where('depositante', $cnpj)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_restricao')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque','asc')
                        ->orderBy('qtd_produto','asc')
                        ->get();
                }
            } else {
                if ($data['value'] == '') {
                    $results = $this->model
                        ->orderBy($order[0], $order[1])->where('depositante', $cnpj)->where('tipo_estoque', $lote)->get();
                } else {
                    $results = $this->model
                        ->where('depositante', $cnpj)
                        ->where('tipo_estoque', $lote)
                        ->where(function ($query) use ($data) {
                            if ($data) {
                                return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                            }
                            return $query;
                        })
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_restricao')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque','asc')
                        ->orderBy('qtd_produto','asc')
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
        $order[0] = $order[0] ?? 'data_atual';
        $order[1] = $order[1] ?? 'asc';
        if ($lote != '') {
            if ($user->role == 'user_company') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($dataEnd) {
                        if ($dataEnd) {
                            return $query->whereRaw('data_geracao BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                        }
                        return $query;
                    })
                    ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                    ->groupBy('codigo_produto')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('depositante')
                    ->groupBy('unidade_medida')
                    ->orderBy('desc_tipo_estoque','asc')
                    ->orderBy('qtd_produto','asc')
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
                    ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                    ->groupBy('codigo_produto')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->orderBy('desc_tipo_estoque','asc')
                    ->orderBy('qtd_produto','asc')
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
                ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida'))
                ->groupBy('codigo_produto')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('data_validade')
                ->groupBy('desc_restricao')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->orderBy('desc_tipo_estoque','asc')
                ->orderBy('qtd_produto','asc')
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
    public function findByLogix($chave)
    {

        $result = $this->model->where('chave_logix', $chave)->first();

        if ($result) {
            Log::info('Registro estoque: ' . $result);
            return $this->parserResult($result);
        } else {
            Log::info('Registro estoque vazio: ' . $result);
            return 0;
        }
    }
}
