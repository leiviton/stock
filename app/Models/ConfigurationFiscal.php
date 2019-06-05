<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ConfigurationFiscal.
 *
 * @package namespace Stock\Models;
 */
class ConfigurationFiscal extends \Stock\Models\Base\ConfigurationFiscal implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serie_nf',
        'senha_certificado',
        'certificado',
        'ultima_nota',
        'logradouro',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'codigo_cidade',
        'estado',
        'codigo_estado'
    ];

}
