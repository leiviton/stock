<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 31 Oct 2019 14:18:49 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class News
 * 
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $author
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class News extends Eloquent
{

}
