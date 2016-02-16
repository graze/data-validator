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

namespace Graze\DataValidator\Processor;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
abstract class AbstractExecutableProcessor
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function __invoke(array $data)
    {
        return $this->process($data);
    }

    /**
     * Apply the processor to the given data.
     *
     * @param array $data
     *
     * @return array
     */
    abstract protected function process(array $data);
}
