<?php

namespace Stock\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Presenters\OutPresenter;
use Stock\Models\Out;

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
            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->groupBy('tipo_estoque')
                    ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_envio')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('nome_destino_final')
                    ->groupBy('centro')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('numero_ordem')
                    ->orderBy($order[0], $order[1])
                    ->get();
            } else {
                $results = $this->model
                    ->where('tipo_estoque', $lote)
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($data) {
                        if ($data['field'] == 'data_envio') {
                            return $query->where($data['field'], $data['value']);
                        } else if ($data) {
                            return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                        }
                        return $query;
                    })
                    ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_envio')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('nome_destino_final')
                    ->groupBy('centro')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('numero_ordem')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
            }
        } else {
            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_envio')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('nome_destino_final')
                    ->groupBy('centro')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('numero_ordem')
                    ->orderBy($order[0], $order[1])
                    ->get();
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
                    ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                    ->groupBy('codigo_produto')
                    ->groupBy('serie_nf')
                    ->groupBy('data_envio')
                    ->groupBy('desc_produto')
                    ->groupBy('tipo_estoque')
                    ->groupBy('lote')
                    ->groupBy('nome_destino_final')
                    ->groupBy('centro')
                    ->groupBy('data_validade')
                    ->groupBy('desc_tipo_estoque')
                    ->groupBy('unidade_medida')
                    ->groupBy('numero_ordem')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
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
        //dd($lote);
        if ($lote != '') {

            $results = $this->model
                ->where('depositante', $cnpj)
                ->where('tipo_estoque', $lote)
                ->where(function ($query) use ($dataEnd) {
                    if ($dataEnd) {
                        return $query->whereRaw('data_envio BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd]);
                    }
                    return $query;
                })
                ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                ->groupBy('codigo_produto')
                ->groupBy('serie_nf')
                ->groupBy('data_envio')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('nome_destino_final')
                ->groupBy('centro')
                ->groupBy('data_validade')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->groupBy('numero_ordem')
                ->orderBy($order[0], $order[1])
                ->paginate();

        } else {

            $results = $this->model
                ->where(function ($query) use ($dataEnd, $cnpj) {
                    if ($dataEnd) {
                        return $query->whereRaw('data_envio BETWEEN ? AND ?', [(new Carbon())->subMonth(6), $dataEnd])
                            ->where('depositante', $cnpj);
                    }
                    return $query;
                })
                ->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                ->groupBy('codigo_produto')
                ->groupBy('serie_nf')
                ->groupBy('data_envio')
                ->groupBy('desc_produto')
                ->groupBy('tipo_estoque')
                ->groupBy('lote')
                ->groupBy('nome_destino_final')
                ->groupBy('centro')
                ->groupBy('data_validade')
                ->groupBy('desc_tipo_estoque')
                ->groupBy('unidade_medida')
                ->groupBy('numero_ordem')
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
            Log::info('Registro saida vazio: ' . $result);
            return '';
        } else {
            //dd('aqui 2');
            Log::info('Registro saida: ' . $result);

            return $result;
        }
    }
}
