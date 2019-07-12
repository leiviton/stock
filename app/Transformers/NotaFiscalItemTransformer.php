<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\NotaFiscalItem;

/**
 * Class NotaFiscalItemTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class NotaFiscalItemTransformer extends TransformerAbstract
{
    /**
     * Transform the NotaFiscalItem entity.
     *
     * @param \Stock\Models\NotaFiscalItem $model
     *
     * @return array
     */
    public function transform(NotaFiscalItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'cEAN' => $model->cEAN,
            'cEANTrib' => $model->cEANTrib,
            'cProd' => $model->cProd,
            'xProd' => $model->xProd,
            'NCM' => $model->NCM,
            'CFOP' => $model->CFOP,
            'uCom' => $model->uCom,
            'qCom' => $model->qCom,
            'vUnCom' => $model->vUnCom,
            'vProd' => $model->vProd,
            'uTrib' => $model->uTrib,
            'qTrib' => $model->qTrib,
            'vUnTrib' => $model->vUnTrib,
            'indTot' => $model->indTot,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
