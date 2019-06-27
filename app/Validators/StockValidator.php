<?php

namespace Stock\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class StockValidator.
 *
 * @package namespace Stock\Validators;
 */
class StockValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'chave_logix' => 'required|unique:stocks,chave_logix'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
