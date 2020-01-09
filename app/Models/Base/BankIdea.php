<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 09 Jan 2020 18:19:19 -0200.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BankIdea
 * 
 * @property int $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $email
 * @property string $titulo
 * @property string $descricao
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class BankIdea extends Eloquent
{

}
