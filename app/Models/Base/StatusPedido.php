<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 13 Sep 2019 16:13:34 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StatusPedido
 * 
 * @property int $id
 * @property string $sc
 * @property string $pedido
 * @property string $cod_status
 * @property string $status_sc
 * @property string $empresa
 * @property string $depositante
 * @property string $tp_estoque
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class StatusPedido extends Eloquent
{
    protected $connection = 'youvita';

    protected $table = 'logix.status_sc';
}
