<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Apr 2019 08:45:07 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Out
 * 
 * @property int $id
 * @property \Carbon\Carbon $data_geracao
 * @property string $depositante
 * @property string $razao_social
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $item
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property \Carbon\Carbon $data_validade
 * @property \Carbon\Carbon $data_envio
 * @property string $serie_nf
 * @property string $nota_fiscal
 * @property string $nome_destino_final
 * @property string $pedido_venda
 * @property string $centro
 * @property string $numero_ordem
 * @property string $qtd_enviada
 * @property string $serie
 * @property string $peca
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class Out extends Eloquent
{
	protected $dates = [
		'data_geracao',
		'data_validade',
		'data_envio'
	];
}
