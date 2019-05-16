<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Road.
 *
 * @package namespace Stock\Models;
 */
class Road extends \Stock\Models\Base\Road implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_geracao',
        'depositante',
        'razao_social',
        'data_recebimento',
        'tipo_estoque',
        'desc_tipo_estoque',
        'cnpj_emissor_nfe',
        'razao_social_fornecedor',
        'codigo_produto',
        'desc_produto',
        'unidade_medida',
        'lote',
        'data_validade',
        'serie_nf',
        'tipo_nf',
        'desc_restricao',
        'serie',
        'peca',
        'qtd_recebida',
        'qtd_fiscal'
    ];

}
