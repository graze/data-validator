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

use Graze\DataValidator\Processor;
use Graze\DataValidator\Validator;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
final class DataValidator implements
    DataValidatorInterface,
    Processor\ProcessorAwareInterface,
    Validator\ValidatorAwareInterface
{
    use Processor\ProcessorAwareTrait;
    use Validator\ValidatorAwareTrait;

    /**
     * {@inheritDoc}
     *
     * @param array $data
     *
     * @return $data
     */
    public function process(array $data)
    {
        $process = function (array $data, callable $processor) {
            return $processor($data);
        };

        return array_reduce($this->processors, $process, $data);
    }

    /**
     * {@inheritDoc}
     *
     * @param array $data
     *
     * @return array
     */
    public function validate(array $data)
    {
        $failedValidators = [];

        /** callable $validator */
        foreach ($this->validators as $validator) {
            /** string|null $failure */
            $failure = $validator($data);

            if ($failure != null) {
                $failedValidators[$failure] = true;
            }
        }

        return $failedValidators;
    }
}
