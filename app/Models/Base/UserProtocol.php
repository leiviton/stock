<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 15 May 2019 15:19:28 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserProtocol
 * 
 * @property int $id
 * @property int $user_id
 * @property int $protocol_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\Protocol $protocol
 * @property \Stock\Models\User $user
 *
 * @package Stock\Models\Base
 */
class UserProtocol extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'protocol_id' => 'int'
	];

	public function protocol()
	{
		return $this->belongsTo(\Stock\Models\Protocol::class);
	}

	public function user()
	{
		return $this->belongsTo(\Stock\Models\User::class);
	}
}
