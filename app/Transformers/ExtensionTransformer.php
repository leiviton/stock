<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\Extension;

/**
 * Class ExtensionTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class ExtensionTransformer extends TransformerAbstract
{
    /**
     * Transform the Extension entity.
     *
     * @param \Stock\Models\Extension $model
     *
     * @return array
     */
    public function transform(Extension $model)
    {
        return [
            'id'         => (int) $model->id,
            'extension' => $model->extension,
            'department' => $model->department,
            'name' => $model->name,
            'image' => env('APP_URL').'/storage/extensions/'.$model->image,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
