<?php

namespace Stock\Presenters;

use Stock\Transformers\ConfigurationFiscalTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ConfigurationFiscalPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class ConfigurationFiscalPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ConfigurationFiscalTransformer();
    }
}
