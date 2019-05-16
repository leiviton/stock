<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 26 Apr 2019 19:52:44 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Road
 * 
 * @property int $id
 * @property int $company_id
 * @property string $data_geracao
 * @property string $depositante
 * @property string $razao_social
 * @property string $data_recebimento
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $cnpj_emissor_nfe
 * @property string $razao_social_fornecedor
 * @property string $codigo_produto
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property string $data_validade
 * @property string $serie_nf
 * @property string $tipo_nf
 * @property string $qtd_recebida
 * @property string $qtd_avariada
 * @property string $desc_restricao
 * @property string $serie
 * @property string $peca
 * @property string $qtd_fiscal
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\Company $company
 *
 * @package Stock\Models\Base
 */
class Road extends Eloquent
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
