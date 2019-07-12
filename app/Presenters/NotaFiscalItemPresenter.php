<?php

namespace Stock\Presenters;

use Stock\Transformers\NotaFiscalItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NotaFiscalItemPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class NotaFiscalItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotaFiscalItemTransformer();
    }
}
