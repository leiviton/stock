<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\News;

/**
 * Class NewsTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class NewsTransformer extends TransformerAbstract
{
    /**
     * Transform the News entity.
     *
     * @param \Stock\Models\News $model
     *
     * @return array
     */
    public function transform(News $model)
    {
        return [
            'id'         => (int) $model->id,
            'title' => $model->title,
            'description' => $model->description,
            'image' => env('APP_URL').'/storage/news/'.$model->image,
            'author' => $model->author,
            'type' => $model->type,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
