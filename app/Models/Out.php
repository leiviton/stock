<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Out.
 *
 * @package namespace Stock\Models;
 */
class Out extends \Stock\Models\Base\Out implements Transformable
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
        'tipo_estoque',
        'item',
        'desc_produto',
        'unidade_medida',
        'lote',
        'data_validade',
        'data_envio',
        'nota_fiscal',
        'serie_nf',
        'nome_destino_final',
        'centro',
        'numero_ordem',
        'qtd_enviada',
        'serie',
        'peca',
        'pedido_venda',
        'solicitacao_carga',
        'chave_nfe'
    ];

}
