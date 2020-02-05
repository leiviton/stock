<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Stock.
 *
 * @package namespace Stock\Models;
 */
class Stock extends \Stock\Models\Base\Stock implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'depositante',
        'cnpj_origem',
        'data_atual',
        'hora_atual',
        'tipo_estoque',
        'desc_tipo_estoque',
        'codigo_produto',
        'desc_produto',
        'unidade_medida',
        'lote',
        'data_validade',
        'desc_restricao',
        'qtd_regul_reser',
        'qtd_produto',
        'qtd_fiscal',
        'qtd_avariada',
        'avaria',
        'peca',
        'serie',
        'company_id',
        'ua_palete',
        'endereco'
    ];

}
