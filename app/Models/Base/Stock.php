<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 26 Apr 2019 19:52:48 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Stock
 * 
 * @property int $id
 * @property string $chave_logix
 * @property int $company_id
 * @property string $data_geracao
 * @property string $depositante
 * @property string $cnpj_origem
 * @property string $data_atual
 * @property string $hora_atual
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $codigo_produto
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property string $data_validade
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
 * @property \Stock\Models\Company $company
 *
 * @package Stock\Models\Base
 */
class Stock extends Eloquent
{
    protected $connection = 'youvita';

    protected $keyType = 'string';

    protected $table = 'logix.stocks';

	protected $casts = [
		'company_id' => 'int',
		'qtd_produto' => 'int',
		'qtd_regul_reser' => 'int',
		'qtd_fiscal' => 'int',
		'qtd_avariada' => 'int'
	];

	protected $dates = [
		'data_geracao'
	];

	public function company()
	{
		return $this->belongsTo(\Stock\Models\Company::class);
	}
}
