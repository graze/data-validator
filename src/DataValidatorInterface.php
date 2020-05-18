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
interface DataValidatorInterface
{
    /**
     * Apply all registered processors to the given data.
     *
     * @param array $data
     *
     * @return array An array of the transformed data.
     */
    public function process(array $data);

    /**
     * Apply all validators to the given data.
     *
     * @param array $data
     *
     * @return array An array of validator failures.
     */
    public function validate(array $data);
}
