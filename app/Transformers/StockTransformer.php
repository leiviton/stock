<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\Stock;

/**
 * Class StockTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class StockTransformer extends TransformerAbstract
{
    /**
     * Transform the Stock entity.
     *
     * @param \Stock\Models\Stock $model
     *
     * @return array
     * @throws \Exception
     */
    public function transform(Stock $model)
    {
        return [
            'id'         => (int) $model->id,
            'data_geracao' => $model->data_geracao,
            'depositante' => $model->depositante,
            'cnpj_origem' => $model->cnpj_origem,
            'data_atual' => $model->data_atual,
            'hora_atual' => $model->hora_atual,
            'tipo_estoque' => $model->tipo_estoque,
            'desc_tipo_estoque' => $model->desc_tipo_estoque,
            'codigo_produto' => $model->codigo_produto,
            'desc_produto' => $model->desc_produto,
            'unidade_medida' => $model->unidade_medida,
            'lote' => $model->lote,
            'data_validade' => date_format(new \DateTime($model->data_validade),'d/m/Y'),
            'desc_restricao' => $model->desc_restricao,
            'qtd_regul_reser' => $model->qtd_regul_reser,
            'qtd_produto' => $model->qtd_produto,
            'qtd_fiscal' => $model->qtd_fiscal,
            'qtd_avariada' => $model->qtd_avariada,
            'avaria' => $model->avaria,
            'peca' => $model->peca,
            'serie' => $model->serie,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
