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

        set_time_limit(0);
        $order[0] = $order[0] ?? 'data_envio';
        $order[1] = $order[1] ?? 'asc';
        //dd($lote);
        if ($lote == '') {
            if ($data['value'] == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->select(DB::raw('tipo_estoque,data_envio,temperatura,serie_nf_entrada,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
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
                    ->groupBy('temperatura')
                    ->groupBy('serie_nf_entrada')
                    ->orderBy($order[0], $order[1])
                    ->get();
            } else {
                //dd('aqui');
                $results = $this->model
                    ->where('depositante', $cnpj)
                    ->where(function ($query) use ($data) {
                        if ($data['field'] == 'data_envio') {
                            return $query->where($data['field'], $data['value']);
                        } else if ($data) {
                            return $query->where($data['field'], 'like', '%' . $data['value'] . '%');
                        }
                    })
                    //->select(DB::raw('tipo_estoque,data_envio,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
                    ->sum('qtd_enviada')
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
                    ->select(DB::raw('tipo_estoque,data_envio,serie_nf_entrada,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
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
                    })
                    ->select(DB::raw('tipo_estoque,data_envio,temperatura,serie_nf_entrada,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
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
     * @param $data
     * @param $cnpj
     * @param string $lote
     * @return mixed
     */
    public function orderFilterData($data, $cnpj, $lote = '')
    {

        set_time_limit(0);
        $order[0] = $order[0] ?? 'data_envio';
        $order[1] = $order[1] ?? 'asc';
        //dd($lote);
        if ($lote == '') {
                $results = $this->model
                    ->where('depositante', $cnpj)
                   // ->where('tipo_estoque', $lote)
                    ->whereBetween('data_envio',[$data['start'],$data['end']])
                    ->select(DB::raw('tipo_estoque,data_envio,temperatura,serie_nf_entrada,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
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
                    ->where('depositante', $cnpj)
                    ->where('tipo_estoque', $lote)
                    ->whereBetween("data_envio",[$data['start'],$data['end']])
                    ->select(DB::raw('tipo_estoque,data_envio,temperatura,serie_nf_entrada,desc_tipo_estoque,centro,nome_destino_final,numero_ordem,sum(outs.qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,desc_produto,unidade_medida,serie_nf,centro'))
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

        set_time_limit(0);
        $dataEnd = date_format(new \DateTime(),'Y-m-d');
        $dateStart = $this->invertDate(date_format((new Carbon())->subDay(30),'d/m/Y'));
        $order[0] = $order[0] ?? 'data_envio';
        $order[1] = $order[1] ?? 'desc';
        //dd($user->role);
        //dd($lote);
        //if ($lote != '') {

            $results = $this->model
                ->where('depositante', $cnpj)
                ->where('tipo_estoque', $lote)
                ->whereBetween("data_envio",[$dateStart,$dataEnd])
                ->select(DB::raw('depositante,tipo_estoque,temperatura,serie_nf_entrada,data_envio,desc_tipo_estoque,nome_destino_final,numero_ordem,
                sum(qtd_enviada) AS qtd_enviada,codigo_produto,lote,data_validade,desc_produto,
                unidade_medida,serie_nf,centro'))
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
                ->groupBy('depositante')
                ->groupBy('temperatura')
                ->groupBy('serie_nf_entrada')
                ->orderBy($order[0], $order[1])
                ->paginate();

        /*} else {
            //dd('a');
            $results = $this->model->whereBetween("data_envio", [$dateStart, $dataEnd])
                ->where('depositante', $cnpj)
                ->select(DB::raw('depositante,tipo_estoque,data_envio,desc_tipo_estoque,nome_destino_final,numero_ordem,
                sum(qtd_enviada) AS qtd_enviada,codigo_produto,desc_produto,lote,data_validade,
                unidade_medida,serie_nf,centro'))
                //->sum('qtd_enviada')
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
                ->groupBy('depositante')
                ->orderBy($order[0], $order[1])
                ->paginate(30);
        }*/

        if ($results) {
            return $this->parserResult($results);
        }

        return $results;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function getQueryAdmin($data) {
        $query = $this->model->where(function ($query) use ($data) {
            return $query->whereRaw('data_envio BETWEEN ? AND ?',
                [$data['start'], $data['end']])->where('depositante',$this->limpaCPF_CNPJ($data['cnpj']));
        })->select(DB::raw('desc_tipo_estoque as Protocolo,codigo_produto as Codigo,desc_produto as Produto,
        unidade_medida as Unidade_Medida,lote as Lote,data_validade as Validade,data_envio as Envio,serie_nf as NFe,
        nome_destino_final as Destino,centro as Centro,numero_ordem as Ordem,
        sum(qtd_enviada) as Qtd,serie as Serie,peca as Peça,temperatura as Temperatura,serie_nf_entrada as NFe_entrada'))
            ->groupBy('data_envio')
            ->groupBy('desc_tipo_estoque')
            ->groupBy('codigo_produto')
            ->groupBy('desc_produto')
            ->groupBy('unidade_medida')
            ->groupBy('lote')
            ->groupBy('data_validade')
            ->groupBy('serie_nf')
            ->groupBy('qtd_enviada')
            ->groupBy('nome_destino_final')
            ->groupBy('centro')
            ->groupBy('serie')
            ->groupBy('peca')
            ->groupBy('numero_ordem')
            ->groupBy('temperatura')
            ->groupBy('serie_nf_entrada')
            ->orderBy('data_envio','asc')
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
            return $query->whereRaw('data_envio BETWEEN ? AND ?',
                [$data['start'], $data['end']])->where('tipo_estoque',$data['protocol']);
        })->select(DB::raw('desc_tipo_estoque as Protocolo,codigo_produto as Codigo,desc_produto as Produto,
        unidade_medida as Unidade_Medida,lote as Lote,data_validade as Validade,data_envio as Envio,serie_nf as NFe,
        nome_destino_final as Destino,centro as Centro,numero_ordem as Ordem,
        sum(qtd_enviada) as Qtd,serie as Serie,peca as Peça'))
            ->groupBy('data_envio')
            ->groupBy('tipo_estoque')
            ->groupBy('desc_tipo_estoque')
            ->groupBy('codigo_produto')
            ->groupBy('desc_produto')
            ->groupBy('unidade_medida')
            ->groupBy('lote')
            ->groupBy('data_validade')
            ->groupBy('serie_nf')
            ->groupBy('qtd_enviada')
            ->groupBy('nome_destino_final')
            ->groupBy('centro')
            ->groupBy('serie')
            ->groupBy('peca')
            ->groupBy('numero_ordem')
            ->orderBy('data_envio','asc')
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
            Log::info('Registro saida vazio: ' . $result);
            return '';
        } else {
            //dd('aqui 2');
            Log::info('Registro saida: ' . $result);

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

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function invertDate($date)
    {
        if (count(explode("/", $date)) > 1) {
            $result = implode("-", array_reverse(explode("/", $date)));
            return $result;
        } else if (count(explode("-", $date)) > 1) {
            $result = implode("/", array_reverse(explode("-", $date)));
            return $result;
        }
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
