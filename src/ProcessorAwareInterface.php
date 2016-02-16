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
interface ProcessorAwareInterface
{
    /**
     * Register a processor.
     *
     * The callable should accept an array as it's only argument.
     *
     * @param callable $processor
     *
     * @return DataValidatorInterface
     */
    public function addProcessor(callable $processor);
}
