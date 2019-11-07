<?php

namespace Stock\Presenters;

use Stock\Transformers\ExtensionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ExtensionPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class ExtensionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ExtensionTransformer();
    }
}
