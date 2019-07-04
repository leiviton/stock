<?php

namespace Stock\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class NotaFiscal.
 *
 * @package namespace Stock\Models;
 */
class NotaFiscal extends \Stock\Models\Base\NotaFiscal implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'nNF',
        'tpNF',
        'idDest',
        'cMunFG',
        'tpImp',
        'cDv',
        'finNFe',
        'indFinal',
        'indPres',
        'procEmi',
        'verProc',
        'xNome',
        'indIEDest',
        'IE',
        'CNPJ',
        'xLgr',
        'nro',
        'xBairro',
        'cMun',
        'xMun',
        'UF',
        'CEP',
        'cPais',
        'xPais',
        'vBC',
        'vICMS',
        'vICMSDeson',
        'vBCST',
        'vST',
        'vProd',
        'vFrete',
        'vSeg',
        'vDesc',
        'vII',
        'vIPI',
        'vPIS',
        'vCOFINS',
        'vOutro',
        'vNF',
        'vTotTrib'
    ];
}
