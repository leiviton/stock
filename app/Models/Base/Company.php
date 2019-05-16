<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 26 Apr 2019 19:52:26 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $cnpj
 * @property string $nome
 * @property string $logo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $outs
 * @property \Illuminate\Database\Eloquent\Collection $roads
 * @property \Illuminate\Database\Eloquent\Collection $stocks
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $protocols
 *
 * @package Stock\Models\Base
 */
class Company extends Eloquent
{
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

	public function protocols()
    {
        return $this->hasMany(\Stock\Models\Protocol::class,'empresa_deposit','cnpj');
    }
}
