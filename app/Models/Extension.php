<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Extension.
 *
 * @package namespace Stock\Models;
 */
class Extension extends \Stock\Models\Base\Extension implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'extension',
        'department',
        'name',
        'image'
    ];
}
