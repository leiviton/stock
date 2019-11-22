<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\StatusPedido;

/**
 * Class StatusPedidoTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class StatusPedidoTransformer extends TransformerAbstract
{
    /**
     * Transform the StatusPedido entity.
     *
     * @param \Stock\Models\StatusPedido $model
     *
     * @return array
     */
    public function transform(StatusPedido $model)
    {
        return [
            'sc' => $model->sc,
            'pedido' => $model->pedido,
            'cod_status' => $model->cod_status,
            'status_sc' => $model->status_sc,
            'depositante' => $model->depositante,
            'tp_estoque' => $model->tp_estoque
        ];
    }
}
