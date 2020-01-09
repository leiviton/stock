<?php

namespace Stock\Presenters;

use Stock\Transformers\BankIdeaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BankIdeaPresenter.
 *
 * @package namespace Stock\Presenters;
 */
class BankIdeaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BankIdeaTransformer();
    }
}
