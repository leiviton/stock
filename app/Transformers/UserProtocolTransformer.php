<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\UserProtocol;

/**
 * Class UserProtocolTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class UserProtocolTransformer extends TransformerAbstract
{
    /**
     * Transform the UserProtocol entity.
     *
     * @param \Stock\Models\UserProtocol $model
     *
     * @return array
     */
    public function transform(UserProtocol $model)
    {
        return [
            'id'         => (int) $model->id,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
