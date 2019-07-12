<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\RoadPresenter;
use Stock\Models\Road;

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
     * @throws \Prettus\Repository\Exceptions\RepositoryException
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
            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_recebimento')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->orderBy($order[0], $order[1])
                    ->get();
            } else {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($data) {
                        return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                    })
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_recebimento')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
            }
        } else {
            /* if ($user->role == 'user_company') {
                 if ($data['value'] == '') {
                     $results = $this->model
                         ->where('depositante', $cnpj)
                         ->where('tipo_estoque', $lote)
                         ->select(DB::raw('tipo_estoque,data_geracao,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                         ->groupBy('codigo_produto')
                         ->groupBy('serie_nf')
                         ->groupBy('data_recebimento')
                         ->groupBy('desc_produto')
                         ->groupBy('tipo_estoque')
                         ->groupBy('lote')
                         ->groupBy('data_validade')
                         ->groupBy('desc_restricao')
                         ->groupBy('desc_tipo_estoque')
                         ->groupBy('unidade_medida')
                         ->orderBy($order[0], $order[1])
                         ->get();
                 } else {
                     $results = $this->model
                         ->where('tipo_estoque', $lote)
                         ->where('depositante', $cnpj)
                         ->where(function ($query) use ($data) {
                             return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                         })
                         ->select(DB::raw('tipo_estoque,data_geracao,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                         ->groupBy('codigo_produto')
                         ->groupBy('serie_nf')
                         ->groupBy('data_recebimento')
                         ->groupBy('desc_produto')
                         ->groupBy('tipo_estoque')
                         ->groupBy('lote')
                         ->groupBy('data_validade')
                         ->groupBy('desc_restricao')
                         ->groupBy('desc_tipo_estoque')
                         ->groupBy('unidade_medida')
                         ->orderBy($order[0], $order[1])
                         ->paginate();
                 }
             } else {*/
            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_recebimento')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->orderBy($order[0], $order[1])
                    ->get();
            } else {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($data) {
                        return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                    })
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_recebimento')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
            }
            //}
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
            /*if ($user->role == 'user_company') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->where(function ($query) use ($dataEnd) {
                        return $query->whereRaw('data_recebimento BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                    })
                    ->select(DB::raw('tipo_estoque,data_geracao,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_recebimento')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('data_validade')
                    ->groupBy('desc_restricao')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('data_geracao')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
            } else {*/
            $results = $this->model
                ->where('tipo_estoque', $lote)
                ->where('depositante', $cnpj)
                ->where(function ($query) use ($dataEnd) {
                    return $query->whereRaw('data_recebimento BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                })
                ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                ->groupBy('codigo_produto')
                ->groupBy('serie_nf')
                ->groupBy('data_recebimento')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('data_validade')
                ->groupBy('desc_restricao')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->orderBy($order[0], $order[1])
                ->paginate();
            //}
        } else {

            $results = $this->model
                ->where('depositante', $cnpj)
                ->where(function ($query) use ($dataEnd) {
                    return $query->whereRaw('data_recebimento BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                })
                ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(roads.qtd_recebida) AS qtd_recebida,sum(roads.qtd_avariada) as qtd_avariada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
                ->groupBy('codigo_produto')
                ->groupBy('serie_nf')
                ->groupBy('data_recebimento')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('data_validade')
                ->groupBy('desc_restricao')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->orderBy($order[0], $order[1])
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

        $result = $this->model->where('chave_logix', '=', $chave)->get()->first();

        if (!$result) {
            //dd('aqui 1');
            Log::info('Registro entradas vazio: ' . $chave);
            return '';
        } else {
            //dd('aqui 2');
            Log::info('Registro entradas: ' . $chave);

            return $result;
        }
    }
}
