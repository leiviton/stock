<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 07 May 2019 21:26:36 +0000.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $role
 * @property string $status
 * @property string $email
 * @property string $img_profile
 * @property \Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $last_login_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $protocols
 *
 * @package Stock\Models\Base
 */
class User extends Eloquent
{
	protected $casts = [
		'company_id' => 'int'
	];

	protected $dates = [
		'email_verified_at',
		'last_login_at'
	];

	public function company()
	{
		return $this->belongsTo(\Stock\Models\Company::class);
	}

	public function protocols()
	{
		return $this->belongsToMany(\Stock\Models\Protocol::class, 'user_protocols')
					->withPivot('id')
					->withTimestamps();
	}
}
