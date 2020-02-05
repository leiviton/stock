<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\Road;

/**
 * Class RoadTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class RoadTransformer extends TransformerAbstract
{
    /**
     * Transform the Road entity.
     *
     * @param \Stock\Models\Road $model
     *
     * @return array
     * @throws \Exception
     */
    public function transform(Road $model)
    {
        return [
            'id'         => $model->id,
            'depositante' => $model->depositante,
            'razao_social' => $model->razao_social,
            'data_recebimento' => date('d/m/Y', strtotime($model->data_recebimento)),
            'tipo_estoque' => $model->tipo_estoque,
            'desc_tipo_estoque' => $model->desc_tipo_estoque,
            'cnpj_emissor_nfe' => $model->cnpj_emissor_nfe,
            'razao_social_fornecedor' => $model->razao_social_fornecedor,
            'codigo_produto' => $model->codigo_produto,
            'desc_produto' => $model->desc_produto,
            'unidade_medida' => $model->unidade_medida,
            'lote' => $model->lote,
            'data_validade' => date('d/m/Y', strtotime($model->data_validade)),
            'serie_nf' => $model->serie_nf_definitiva,
            'tipo_nf' => $model->tipo_nf,
            'desc_restricao' => $model->desc_restricao,
            'serie' => $model->serie,
            'peca' => $model->peca,
            'qtd_recebida' => $model->qtd_recebida,
            'qtd_avariada' => $model->qtd_avariada,
            'qtd_fiscal' => $model->qtd_fiscal,
            'serie_nf_provisoria' => $model->serie_nf_provisória,
            'usuario_inclusao' => $model->usuario_inclusao,
            'temperatura' => $model->temperatura,
            'area' => $model->area,
            'portaria_34498' => $model->portaria_34498,
            'transportadora' => $model->transportadora,
            'guia' => $model->guia,
            'conferente_1' => $model->conferente_1,
            'conferente_2' => $model->conferente_2,
            'liberado_em' => $model->liberado_em,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
