<?php

namespace Stock\Presenters;

use Stock\Transformers\UserProtocolTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserProtocolPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class UserProtocolPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserProtocolTransformer();
    }
}
