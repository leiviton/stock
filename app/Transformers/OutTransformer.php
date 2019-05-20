<?php

namespace Stock\Transformers;

use Faker\Provider\DateTime;
use League\Fractal\TransformerAbstract;
use Stock\Models\Out;

/**
 * Class OutTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class OutTransformer extends TransformerAbstract
{
    /**
     * Transform the Out entity.
     *
     * @param \Stock\Models\Out $model
     *
     * @return array
     */
    public function transform(Out $model)
    {
        return [
            'id'         => (int) $model->id,
            'chave_logix'         => $model->chave_logix,
            'data_geracao' => $model->data_geracao,
            'depositante' => $model->depositante,
            'razao_social' => $model->razao_social,
            'tipo_estoque' => $model->tipo_estoque,
            'desc_tipo_estoque' => $model->desc_tipo_estoque,
            'codigo_produto' => $model->codigo_produto,
            'desc_produto' => $model->desc_produto,
            'unidade_medida' => $model->unidade_medida,
            'lote' => $model->lote,
            'data_validade' => date('d/m/Y', strtotime($model->data_validade)),
            'data_envio' =>  date( 'd/m/Y', strtotime($model->data_envio)),
            'nota_fiscal' => $model->nota_fiscal,
            'serie_nf' => $model->serie_nf,
            'nome_destino_final' => $model->nome_destino_final,
            'centro' => $model->centro,
            'numero_ordem' => $model->numero_ordem,
            'qtd_enviada' => $model->qtd_enviada,
            'serie' => $model->serie,
            'peca' => $model->peca,
            'pedido_venda' => $model->pedido_venda,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
