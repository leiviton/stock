<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StatusPedido.
 *
 * @package namespace Stock\Models;
 */
class StatusPedido extends \Stock\Models\Base\StatusPedido implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sc',
        'pedido',
        'cod_status',
        'status_sc',
        'empresa',
        'depositante',
        'tp_estoque'
    ];
}
