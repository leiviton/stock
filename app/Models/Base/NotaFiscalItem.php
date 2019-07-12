<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jul 2019 12:08:49 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NotaFiscalItem
 * 
 * @property int $id
 * @property int $nota_id
 * @property string $cEAN
 * @property string $cEANTrib
 * @property string $cProd
 * @property string $xProd
 * @property string $NCM
 * @property string $CFOP
 * @property string $uCom
 * @property string $qCom
 * @property string $vUnCom
 * @property string $vProd
 * @property string $uTrib
 * @property string $qTrib
 * @property string $vUnTrib
 * @property string $indTot
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\NotaFiscal $nota_fiscal
 *
 * @package Stock\Models\Base
 */
class NotaFiscalItem extends Eloquent
{
	protected $casts = [
		'nota_id' => 'int'
	];

	public function nota_fiscal()
	{
		return $this->belongsTo(\Stock\Models\NotaFiscal::class, 'nota_id');
	}
}
