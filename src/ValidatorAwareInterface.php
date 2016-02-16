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

namespace Graze\DataValidator;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
interface ValidatorAwareInterface
{
    /**
     * Register a validator.
     *
     * The callable should accept an array as it's only argument.
     *
     * The validator callable should return `null` if the given data is valid.
     *
     * Otherwise it should return a `string` that will be appended
     * to the array returned by calls to {@see DataValidatorInterface::validate()}.
     *
     * @param callable $validator
     *
     * @return DataValidatorInterface
     */
    public function addValidator(callable $validator);
}
