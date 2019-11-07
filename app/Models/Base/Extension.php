<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 07 Nov 2019 12:38:45 -0200.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Extension
 * 
 * @property int $id
 * @property string $extension
 * @property string $department
 * @property string $name
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class Extension extends Eloquent
{

}
