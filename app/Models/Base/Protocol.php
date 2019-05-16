<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 07 May 2019 21:26:20 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Protocol
 * 
 * @property int $id
 * @property string $tip_estoque
 * @property string $abrang
 * @property string $empresa_deposit
 * @property string $des_tip_estoque
 * @property string $des_reduz_tip_estoque
 * @property string $padrao
 * @property int $sit_registro
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package Stock\Models\Base
 */
class Protocol extends Eloquent
{
	protected $casts = [
		'sit_registro' => 'int'
	];

	public function users()
	{
		return $this->hasMany(\Stock\Models\UserProtocol::class);
	}

    public function company()
    {
        return $this->belongsTo(\Stock\Models\Company::class);
    }
}
