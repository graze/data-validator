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

use InvalidArgumentException;
use Respect\Validation\Validatable;

/**
 * Adapter to support the respect/validation library.
 *
 * @author Samuel Parkinson <sam@graze.com>
 */
class RespectValidationAdapter extends AbstractExecutableAdapter
{
    /**
     * @var Respect\Validation\Validatable
     */
    protected $validator;

    /**
     * Creates a new instance of the RespectValidationAdapter class.
     *
     * @param string $name
     * @param Validatable $validator
     *
     * @throws InvalidArgumentException
     */
    public function __construct($name, Validatable $validator)
    {
        if (! is_string($name)) {
            throw new InvalidArgumentException('`$name` parameter must be a string.');
        }

        $validator->setName($name);
        $this->validator = $validator;
    }

    /**
     * Validates the given data against the Respect\Validation validator.
     *
     * @param array $data
     *
     * @return string
     */
    protected function validate(array $data)
    {
        if (! $this->validator->validate($data)) {
            return $this->validator->getName();
        }
    }
}
