<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\BankIdea;

/**
 * Class BankIdeaTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class BankIdeaTransformer extends TransformerAbstract
{
    /**
     * Transform the BankIdea entity.
     *
     * @param \Stock\Models\BankIdea $model
     *
     * @return array
     */
    public function transform(BankIdea $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome' => $model->nome,
            'sobrenome' => $model->sobrenome,
            'email' => $model->email,
            'titulo' => $model->titulo,
            'descricao' => $model->descricao,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
