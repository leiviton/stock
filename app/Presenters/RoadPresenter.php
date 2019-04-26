<?php

namespace Stock\Presenters;

use Stock\Transformers\RoadTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoadPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class RoadPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoadTransformer();
    }
}
