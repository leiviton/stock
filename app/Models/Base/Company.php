<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Jun 2019 23:03:10 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property int $configuration_fiscal_id
 * @property string $cnpj
 * @property string $nome
 * @property string $logo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\ConfigurationFiscal $configuration_fiscal
 * @property \Illuminate\Database\Eloquent\Collection $outs
 * @property \Illuminate\Database\Eloquent\Collection $roads
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package Stock\Models\Base
 */
class Company extends Eloquent
{
	protected $casts = [
		'configuration_fiscal_id' => 'int'
	];

	public function configuration_fiscal()
	{
		return $this->belongsTo(\Stock\Models\ConfigurationFiscal::class);
	}

	public function outs()
	{
		return $this->hasMany(\Stock\Models\Out::class);
	}

	public function roads()
	{
		return $this->hasMany(\Stock\Models\Road::class);
	}

	public function stocks()
	{
		return $this->hasMany(\Stock\Models\Stock::class);
	}

	public function users()
	{
		return $this->hasMany(\Stock\Models\User::class);
	}
}
