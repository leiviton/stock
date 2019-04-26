<?php

namespace Stock\Presenters;

use Stock\Transformers\StockTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StockPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class StockPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StockTransformer();
    }
}
