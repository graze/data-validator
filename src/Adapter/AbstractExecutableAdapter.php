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

namespace Graze\DataValidator\Adapter;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
abstract class AbstractExecutableAdapter
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function __invoke(array $data)
    {
        return $this->validate($data);
    }

    /**
     * Validate the given data.
     *
     * The validator should return `null` if the given data is valid.
     *
     * Otherwise it should return a `string` that will be appended
     * to the array returned by calls to {@see DataValidatorInterface::validate()}.
     *
     * @param array $data
     *
     * @return string|null
     */
    abstract protected function validate(array $data);
}
