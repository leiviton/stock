<?php

namespace Stock\Presenters;

use Stock\Transformers\NotaFiscalTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NotaFiscalPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class NotaFiscalPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotaFiscalTransformer();
    }
}
