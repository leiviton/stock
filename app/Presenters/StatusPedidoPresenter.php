<?php

namespace Stock\Presenters;

use Stock\Transformers\StatusPedidoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatusPedidoPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class StatusPedidoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatusPedidoTransformer();
    }
}
