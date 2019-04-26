<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Apr 2019 08:32:20 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Stock
 * 
 * @property int $id
 * @property \Carbon\Carbon $data_geracao
 * @property string $depositante
 * @property string $cnpj_origem
 * @property \Carbon\Carbon $data_atual
 * @property string $hora_atual
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $codigo_produto
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property \Carbon\Carbon $data_validade
 * @property string $desc_restricao
 * @property int $qtd_produto
 * @property int $qtd_regul_reser
 * @property int $qtd_fiscal
 * @property int $qtd_avariada
 * @property string $avaria
 * @property string $peca
 * @property string $serie
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class Stock extends Eloquent
{
	protected $casts = [
		'qtd_produto' => 'int',
		'qtd_regul_reser' => 'int',
		'qtd_fiscal' => 'int',
		'qtd_avariada' => 'int'
	];

	protected $dates = [
		'data_geracao',
		'data_atual',
		'data_validade'
	];
}
