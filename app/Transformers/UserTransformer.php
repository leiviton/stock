<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['company'];
    /**
     * Transform the User entity.
     *
     * @param \Stock\Models\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'email' => $model->email,
            'role' => $model->role,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCompany(User $user)
    {
        return $user->company ? $this->item($user->company, new CompanyTransformer()): null;
    }
}
