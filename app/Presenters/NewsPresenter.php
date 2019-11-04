<?php

namespace Stock\Presenters;

use Stock\Transformers\NewsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NewsPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class NewsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NewsTransformer();
    }
}
