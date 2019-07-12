<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 05 Jul 2019 12:08:34 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class NotaFiscal
 * 
 * @property int $id
 * @property int $company_id
 * @property int $nNF
 * @property string $tpNF
 * @property string $idDest
 * @property string $cMunFG
 * @property string $tpImp
 * @property string $cDv
 * @property string $finNFe
 * @property string $indFinal
 * @property string $indPres
 * @property string $procEmi
 * @property string $verProc
 * @property string $xNome
 * @property string $indIEDest
 * @property string $IE
 * @property string $CNPJ
 * @property string $xLgr
 * @property string $nro
 * @property string $xBairro
 * @property string $cMun
 * @property string $xMun
 * @property string $UF
 * @property string $CEP
 * @property string $cPais
 * @property string $xPais
 * @property float $vBC
 * @property float $vICMS
 * @property float $vICMSDeson
 * @property float $vBCST
 * @property float $vST
 * @property float $vProd
 * @property float $vFrete
 * @property float $vSeg
 * @property float $vDesc
 * @property float $vII
 * @property float $vIPI
 * @property float $vPIS
 * @property float $vCOFINS
 * @property float $vOutro
 * @property float $vNF
 * @property float $vTotTrib
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Stock\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection $nota_fiscal_items
 *
 * @package Stock\Models\Base
 */
class NotaFiscal extends Eloquent
{
	protected $table = 'nota_fiscal';

	protected $casts = [
		'company_id' => 'int',
		'nNF' => 'int',
		'vBC' => 'float',
		'vICMS' => 'float',
		'vICMSDeson' => 'float',
		'vBCST' => 'float',
		'vST' => 'float',
		'vProd' => 'float',
		'vFrete' => 'float',
		'vSeg' => 'float',
		'vDesc' => 'float',
		'vII' => 'float',
		'vIPI' => 'float',
		'vPIS' => 'float',
		'vCOFINS' => 'float',
		'vOutro' => 'float',
		'vNF' => 'float',
		'vTotTrib' => 'float'
	];

	public function company()
	{
		return $this->belongsTo(\Stock\Models\Company::class);
	}

	public function nota_fiscal_items()
	{
		return $this->hasMany(\Stock\Models\NotaFiscalItem::class, 'nota_id');
	}
}
