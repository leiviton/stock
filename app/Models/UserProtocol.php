<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserProtocol.
 *
 * @package namespace Stock\Models;
 */
class UserProtocol extends \Stock\Models\Base\User implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'protocol_id'
    ];

}
