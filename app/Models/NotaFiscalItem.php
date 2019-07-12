<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class NotaFiscalItem.
 *
 * @package namespace Stock\Models;
 */
class NotaFiscalItem extends \Stock\Models\Base\NotaFiscalItem implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nota_id',
        'cEAN',
        'cEANTrib',
        'cProd',
        'xProd',
        'NCM',
        'CFOP',
        'uCom',
        'qCom',
        'vUnCom',
        'vProd',
        'uTrib',
        'qTrib',
        'vUnTrib',
        'indTot'
    ];
}
