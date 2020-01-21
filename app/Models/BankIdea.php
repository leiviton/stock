<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BankIdea.
 *
 * @package namespace Stock\Models;
 */
class BankIdea extends \Stock\Models\Base\BankIdea implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'celular',
        'email',
        'titulo',
        'descricao'
    ];

}
