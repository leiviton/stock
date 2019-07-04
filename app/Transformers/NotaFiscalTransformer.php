<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\NotaFiscal;

/**
 * Class NotaFiscalTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class NotaFiscalTransformer extends TransformerAbstract
{
    /**
     * Transform the NotaFiscal entity.
     *
     * @param \Stock\Models\NotaFiscal $model
     *
     * @return array
     */
    public function transform(NotaFiscal $model)
    {
        return [
            'id'  => (int) $model->id,
            'nNF' => $model->nNF,
            'tpNF' => $model->tpNF,
            'idDest' => $model->idDest,
            'cMunFG' => $model->cMunFG,
            'tpImp' => $model->tpImp,
            'cDv' => $model->cDv,
            'finNFe' => $model->finNFe,
            'indFinal' => $model->indFinal,
            'indPres' => $model->indPres,
            'procEmi' => $model->procEmi,
            'verProc' => $model->verProc,
            'xNome' => $model->xNome,
            'indIEDest' => $model->indIEDest,
            'IE' => $model->IE,
            'CNPJ' => $model->CNPJ,
            'xLgr' => $model->xLgr,
            'nro' => $model->nro,
            'xBairro' => $model->xBairro,
            'cMun' => $model->cMun,
            'xMun' => $model->xMun,
            'UF' => $model->UF,
            'CEP' => $model->CEP,
            'cPais' => $model->cPais,
            'xPais' => $model->xPais,
            'vBC' => $model->vBC,
            'vICMS' => $model->vICMS,
            'vICMSDeson' => $model->vICMSDeson,
            'vBCST' => $model->vBCST,
            'vST' => $model->vST,
            'vProd' => $model->vProd,
            'vFrete' => $model->vFrete,
            'vSeg' => $model->vSeg,
            'vDesc' => $model->vDesc,
            'vII' => $model->vII,
            'vIPI' => $model->vIPI,
            'vPIS' => $model->vPIS,
            'vCOFINS' => $model->vCOFINS,
            'vOutro' => $model->vOutro,
            'vNF' => $model->vNF,
            'vTotTrib' => $model->vTotTrib,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
