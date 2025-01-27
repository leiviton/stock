<?php

namespace Stock\Repositories;

use Illuminate\Support\Facades\DB;
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
        set_time_limit(0);
        $order[0] = $order[0] ?? 'data_atual';
        $order[1] = $order[1] ?? 'desc';
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
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque, sum(stocks.qtd_produto) AS qtd_produto,codigo_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,desc_produto,lote,data_validade,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque', 'asc')
                        ->orderBy('qtd_produto', 'asc')
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
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque,ua_palete,endereco,sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque', 'asc')
                        ->orderBy('qtd_produto', 'asc')
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
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque,sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque', 'asc')
                        ->orderBy('qtd_produto', 'asc')
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
                        ->select(DB::raw('tipo_estoque,desc_tipo_estoque,ua_palete,endereco,sum(stocks.qtd_produto) AS qtd_produto,sum(stocks.qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                        ->groupBy('codigo_produto')
                        ->groupBy('desc_produto')
                        ->groupBy('tipo_estoque')
                        ->groupBy('lote')
                        ->groupBy('data_validade')
                        ->groupBy('desc_tipo_estoque')
                        ->groupBy('depositante')
                        ->groupBy('unidade_medida')
                        ->orderBy('desc_tipo_estoque', 'asc')
                        ->orderBy('qtd_produto', 'asc')
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
    public function orderByStocks($user, $cnpj, $lote)
    {
        set_time_limit(0);
        $order[0] = $order[0] ?? 'data_atual';
        $order[1] = $order[1] ?? 'desc';
        if ($lote != '') {
            if ($user->role == 'user_company') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    //->select(DB::raw('tipo_estoque,desc_tipo_estoque,qtd_produto,qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                    ->select(DB::raw('tipo_estoque,desc_tipo_estoque,sum(qtd_produto) AS qtd_produto,sum(qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                    ->groupBy('codigo_produto')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('depositante')
                    ->groupBy('unidade_medida')
                    ->orderBy('desc_tipo_estoque', 'asc')
                    //->orderBy('qtd_produto', 'asc')
                    ->paginate();
            } else {
                $results = $this->model
                    ->where('tipo_estoque', $lote)
                    ->where('depositante', $cnpj)
                    ->select(DB::raw('tipo_estoque,desc_tipo_estoque,ua_palete,endereco,sum(qtd_produto) AS qtd_produto,sum(qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                    //->select(DB::raw('tipo_estoque,desc_tipo_estoque,qtd_produto,qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                    ->groupBy('codigo_produto')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('ua_palete')
                    ->groupBy('endereco')
                    ->orderBy('desc_tipo_estoque', 'asc')
                    //->orderBy('qtd_produto', 'asc')
                    ->paginate();
            }
        } else {

            $results = $this->model
                ->where('depositante', $cnpj)
                ->select(DB::raw('tipo_estoque,desc_tipo_estoque,ua_palete,endereco,sum(qtd_produto) AS qtd_produto,sum(qtd_regul_reser) AS qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                //->select(DB::raw('tipo_estoque,desc_tipo_estoque,qtd_produto,qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
                ->groupBy('codigo_produto')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('data_validade')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->groupBy('ua_palete')
                ->groupBy('endereco')
                ->orderBy('desc_tipo_estoque', 'asc')
                //->orderBy('qtd_produto', 'asc')
                ->paginate();

        }

        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getQueryAdmin($data)
    {
        set_time_limit(0);
        $query = $this->model->where('depositante', $data['cnpj'])
            ->select(DB::raw('tipo_estoque as Protocolo,desc_tipo_estoque as DescProtocolo,ua_palete as UA_Palete,endereco as Endereço,
            codigo_produto as Codigo_Produto,desc_produto as Produto,unidade_medida as Unidade_Medida,lote,
            data_validade as Data_Validade,desc_restricao as Restricao,qtd_regul_reser as Qtd_Reservada,
            qtd_produto as Qtd,qtd_avariada as Qtd_Avariada,peca as Peca,serie as Serie'))
            ->orderBy('desc_produto', 'asc')
            ->get();

        return $query;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getQueryUser($data)
    {
        set_time_limit(0);
        $query = $this->model->where('tipo_estoque', $data['protocol'])
            ->select(DB::raw('tipo_estoque as Protocolo', 'desc_tipo_estoque as DescProtocolo',
                'codigo_produto as CodigoProduto', 'desc_produto as DescProduto', 'unidade_medida as UnidadeMedida', 'lote',
                'data_validade as DataValidade', 'desc_restricao as Restricao', 'qtd_regul_reser as QtdReservada',
                'qtd_produto as Qtd', 'qtd_avariada as QtdAvariada', 'peca as Peca', 'serie as Serie'))
            ->orderBy('desc_produto', 'asc')
            ->get();


        return $query;
    }

    /**
     * @param $id
     * @param $tipo
     * @return mixed
     */
    public function findById($id,$tipo)
    {
        $tipo = explode(',',$tipo);

        //dd($tipo);
        $result = $this->model
            ->where('codigo_produto',$id)
            ->whereIn('tipo_estoque',$tipo)
            ->select(DB::raw('sum(qtd_produto) AS qtd_produto'))
            //->select(DB::raw('tipo_estoque,desc_tipo_estoque,qtd_produto,qtd_regul_reser,codigo_produto,desc_produto,lote,data_validade,unidade_medida'))
            ->groupBy('codigo_produto')
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }

        return $result;
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
}
