<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\ConfigurationFiscal;

/**
 * Class ConfigurationFiscalTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class ConfigurationFiscalTransformer extends TransformerAbstract
{
    /**
     * Transform the ConfigurationFiscal entity.
     *
     * @param \Stock\Models\ConfigurationFiscal $model
     *
     * @return array
     */
    public function transform(ConfigurationFiscal $model)
    {
        return [
            'id'         => (int) $model->id,
            'serie_nf' => $model->serie_nf,
            'senha_certificado' => $model->senha_certificado,
            'certificado' => $model->certificado,
            'ultima_nota' => $model->ultima_nota,
            'logradouro' => $model->logradouro,
            'numero' => $model->numero,
            'bairro' => $model->bairro,
            'cep' => $model->cep,
            'cidade' => $model->cidade,
            'codigo_cidade' => $model->codigo_cidade,
            'estado' => $model->estado,
            'codigo_estado' => $model->codigo_estado,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
