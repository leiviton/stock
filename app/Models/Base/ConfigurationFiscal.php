<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 23:01:19 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ConfigurationFiscal
 * 
 * @property int $id
 * @property int $serie_nf
 * @property string $senha_certificado
 * @property string $certificado
 * @property int $ultima_nota
 * @property string $logradouro
 * @property string $numero
 * @property string $bairro
 * @property string $cep
 * @property string $cidade
 * @property string $codigo_cidade
 * @property string $estado
 * @property string $codigo_estado
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $companies
 *
 * @package Stock\Models\Base
 */
class ConfigurationFiscal extends Eloquent
{
	protected $table = 'configuration_fiscal';

	protected $casts = [
		'serie_nf' => 'int',
		'ultima_nota' => 'int'
	];

	public function companies()
	{
		return $this->hasMany(\Stock\Models\Company::class);
	}
}
