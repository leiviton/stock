<?php

namespace Stock\Transformers;

use League\Fractal\TransformerAbstract;
use Stock\Models\Company;

/**
 * Class CompanyTransformer.
 *
 * @package namespace Stock\Transformers;
 */
class CompanyTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['configuration'];

    /**
     * Transform the Company entity.
     *
     * @param \Stock\Models\Company $model
     *
     * @return array
     */
    public function transform(Company $model)
    {
        return [
            'id' => (int)$model->id,
            'cnpj' => $model->cnpj,
            'nome' => $model->nome,
            'logo' => env('APP_URL') . '/storage/companies/' . $model->logo,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }


    /**
     * @param Company $company
     * @return \League\Fractal\Resource\Item
     */
    public function includeConfiguration(Company $company)
    {
        return $company->configuration_fiscal ? $this->item($company->configuration_fiscal, new ConfigurationFiscalTransformer()) : null;
    }
}
