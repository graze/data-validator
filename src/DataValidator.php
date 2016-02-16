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
final class DataValidator implements DataValidatorInterface
{
    /**
     * @var array
     */
    private $validators = [];

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
