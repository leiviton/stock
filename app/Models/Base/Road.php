<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Apr 2019 08:32:14 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Road
 * 
 * @property int $id
 * @property \Carbon\Carbon $data_geracao
 * @property string $depositante
 * @property string $razao_social
 * @property \Carbon\Carbon $data_recibimento
 * @property string $tipo_estoque
 * @property string $desc_tipo_estoque
 * @property string $cnpj_emissor_nfe
 * @property string $razao_social_fornecedor
 * @property string $codigo_produto
 * @property string $desc_produto
 * @property string $unidade_medida
 * @property string $lote
 * @property \Carbon\Carbon $data_validade
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
 * @package Stock\Models\Base
 */
class Road extends Eloquent
{
	protected $dates = [
		'data_geracao',
		'data_recibimento',
		'data_validade'
	];
}
