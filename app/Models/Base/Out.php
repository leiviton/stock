<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 26 Apr 2019 19:52:53 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Out
 * 
 * @property int $id
 * @property int $company_id
 * @property \Carbon\Carbon $data_geracao
 * @property string $depositante
 * @property string $razao_social
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $codigo_produto
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property string $data_validade
 * @property string $data_envio
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
 * @property \Stock\Models\Company $company
 *
 * @package Stock\Models\Base
 */
class Out extends Eloquent
{
	protected $casts = [
		'company_id' => 'int'
	];

	protected $dates = [
		'data_geracao'
	];

	public function company()
	{
		return $this->belongsTo(\Stock\Models\Company::class);
	}
}
