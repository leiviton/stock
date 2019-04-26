<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 24 Apr 2019 12:13:53 -0300.
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
 * @property \Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $last_login_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\Company $company
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
}
