<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Protocol.
 *
 * @package namespace Stock\Models;
 */
class Protocol extends \Stock\Models\Base\Protocol implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tip_estoque',
        'abrang',
        'empresa_deposit',
        'des_tip_estoque',
        'des_reduz_tip_estoque',
        'padrao',
        'sit_registro'
    ];
}
