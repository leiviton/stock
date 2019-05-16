<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\Protocol;

/**
 * Class ProtocolTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProtocolTransformer extends TransformerAbstract
{
    /**
     * Transform the Protocol entity.
     *
     * @param \Stock\Models\Protocol $model
     *
     * @return array
     */
    public function transform(Protocol $model)
    {
        return [
            'id'         => (int) $model->id,
            'tip_estoque' => $model->tip_estoque,
            'abrang' => $model->abrang,
            'empresa_deposit' => $model->empresa_deposit,
            'des_tip_estoque' => rtrim($model->des_tip_estoque),
            'des_reduz_tip_estoque' => $model->des_reduz_tip_estoque,
            'padrao' => $model->padrao,
            'sit_registro' => $model->sit_registro,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
