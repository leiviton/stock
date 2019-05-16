<?php

namespace Stock\Presenters;

use Stock\Transformers\ProtocolTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProtocolPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class ProtocolPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProtocolTransformer();
    }
}
