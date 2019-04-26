<?php

namespace Stock\Presenters;

use Stock\Transformers\OutTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OutPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class OutPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OutTransformer();
    }
}
