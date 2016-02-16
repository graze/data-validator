<?php

/**
 * This file is part of graze/data-validator.
 *
 * Copyright (c) 2016 Nature Delivered Ltd. <https://www.graze.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://github.com/graze/data-validator/blob/master/LICENSE MIT
 */

namespace Graze\DataValidator\Validator;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
trait ValidatorAwareTrait
{
    /**
     * @var array
     */
    protected $validators = [];

    /**
     * {@inheritDoc}
     *
     * @param callable $validator
     *
     * @return DataValidatorInterface
     */
    public function addValidator(callable $validator)
    {
        $this->validators[] = $validator;

        return $this;
    }
}
