<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\User;
use Stock\Models\UserProtocol;

/**
 * Class UserTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['company'];

    protected $defaultIncludes = ['protocols'];
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
            'status' => $model->status,
            'img_profile' => env('URL').'/storage/users/'.$model->img_profile,
            'first_login' => $model->first_login,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Item|null
     */
    public function includeCompany(User $user)
    {
        return $user->company ? $this->item($user->company, new CompanyTransformer()): null;
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeProtocols(User $user)
    {
        return $user->protocols ? $this->collection($user->protocols, new ProtocolTransformer()) : null;
    }
}
