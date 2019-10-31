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
                //dd('a');
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
                    ->groupBy('qtd_recebida')
                    ->orderBy($order[0], $order[1])
                    ->get();
            } else {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($data) {
                        return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                    })
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
                    ->groupBy('qtd_recebida')
                    ->orderBy($order[0], $order[1])
                    ->paginate();
            }
        } else {

            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(qtd_recebida) AS qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
                    ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(qtd_recebida) AS qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
        }

        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * @param $data
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilterData($data, $cnpj, $lote = '')
    {
        $order[0] = $order[0] ?? 'data_recebimento';
        $order[1] = $order[1] ?? 'asc';
        //dd($lote);
        if ($lote == '') {
            $results = $this->model
                ->where('depositante', $cnpj)
                ->whereBetween("data_recebimento", [$data['start'], $data['end']])
                ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(qtd_recebida) AS qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
                ->whereBetween("data_recebimento", [$data['start'], $data['end']])
                ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque, sum(qtd_recebida) AS qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_produto,desc_restricao,unidade_medida,serie_nf'))
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
        $dataStart = (new Carbon())->subDay(90);
        $order[0] = $order[0] ?? 'data_recebimento';
        $order[1] = $order[1] ?? 'desc';
        if ($lote != '') {
            $results = $this->model
                ->where('tipo_estoque', $lote)
                ->where('depositante', $cnpj)
                ->where(function ($query) use ($dataEnd, $dataStart) {
                    return $query->whereRaw('data_recebimento BETWEEN ? AND ?', [$dataStart, $dataEnd]);
                })
                ->select(DB::raw('tipo_estoque,data_recebimento,desc_tipo_estoque,qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida,serie_nf'))
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
                ->groupBy('qtd_recebida')
                ->orderBy($order[0], $order[1])
                ->paginate();
        } else {
            //dd($dataStart);
            $results = $this->model
                ->where('depositante', $cnpj)
                ->where(function ($query) use ($dataEnd, $dataStart) {
                    return $query->whereRaw('data_recebimento BETWEEN ? AND ?', [$dataStart, $dataEnd]);
                })
                ->select(DB::raw('depositante,tipo_estoque,data_recebimento,desc_tipo_estoque,qtd_recebida,sum(qtd_rejeitada) as qtd_rejeitada,codigo_produto,desc_produto,lote,data_validade,desc_restricao,unidade_medida,serie_nf'))
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
                ->groupBy('depositante')
                ->groupBy('qtd_recebida')
                ->orderBy($order[0], $order[1])
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
        $query = $this->model->where(function ($query) use ($data) {
            return $query->whereRaw('data_recebimento BETWEEN ? AND ?',
                [$data['start'], $data['end']])->where('depositante', $this->limpaCPF_CNPJ($data['cnpj']));
        })->select(DB::raw('data_recebimento as Recebimento,desc_tipo_estoque as Protocolo,cnpj_emissor_nfe as Emitente,
                razao_social_fornecedor as Fornecedor,codigo_produto as Codigo,desc_produto as Produto,
                unidade_medida as Unidade_Medida,lote as Lote,data_validade as Validade,serie_nf as NFe,
                desc_restricao as Restricao,serie as Serie,peca as Peca,sum(qtd_recebida) as Qtd_Recebida,
                sum(qtd_rejeitada) as Qtd_Avariada,sum(qtd_fiscal) as Qtd_Fiscal'))
            ->groupBy('data_recebimento')
            ->groupBy('tipo_estoque')
            ->groupBy('desc_tipo_estoque')
            ->groupBy('cnpj_emissor_nfe')
            ->groupBy('razao_social_fornecedor')
            ->groupBy('codigo_produto')
            ->groupBy('desc_produto')
            ->groupBy('unidade_medida')
            ->groupBy('lote')
            ->groupBy('data_validade')
            ->groupBy('serie_nf')
            ->groupBy('qtd_recebida')
            ->groupBy('qtd_rejeitada')
            ->groupBy('desc_restricao')
            ->groupBy('serie')
            ->groupBy('peca')
            ->groupBy('qtd_fiscal')
            ->orderBy('data_recebimento', 'asc')
            ->get();

        return $query;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getQueryUser($data)
    {
        $query = $this->model->where(function ($query) use ($data) {
            return $query->whereRaw('data_recebimento BETWEEN ? AND ?',
                [$data['start'], $data['end']])->where('tipo_estoque', $data['protocol']);
        })->select(DB::raw('data_recebimento as Recebimento,desc_tipo_estoque as Protocolo,cnpj_emissor_nfe as Emitente,
                razao_social_fornecedor as Fornecedor,codigo_produto as Codigo,desc_produto as Produto,
                unidade_medida as Unidade_Medida,lote as Lote,data_validade as Validade,serie_nf as NFe,
                desc_restricao as Restricao,serie as Serie,peca as Peca,sum(qtd_recebida) as Qtd_Recebida,
                sum(qtd_rejeitada) as qtd_rejeitada,sum(qtd_fiscal) as Qtd_Fiscal'))
            ->groupBy('data_recebimento')
            ->groupBy('tipo_estoque')
            ->groupBy('desc_tipo_estoque')
            ->groupBy('cnpj_emissor_nfe')
            ->groupBy('razao_social_fornecedor')
            ->groupBy('codigo_produto')
            ->groupBy('desc_produto')
            ->groupBy('unidade_medida')
            ->groupBy('lote')
            ->groupBy('data_validade')
            ->groupBy('serie_nf')
            ->groupBy('tipo_nf')
            ->groupBy('qtd_recebida')
            ->groupBy('qtd_rejeitada')
            ->groupBy('desc_restricao')
            ->groupBy('serie')
            ->groupBy('peca')
            ->groupBy('qtd_fiscal')
            ->orderBy('data_recebimento', 'asc')
            ->get();


        return $query;
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

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }
}
