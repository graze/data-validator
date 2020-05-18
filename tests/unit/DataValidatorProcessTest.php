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

namespace Graze\DataValidator\Test;

use Graze\DataValidator\DataValidator;
use Graze\DataValidator\DataValidatorInterface;
use PHPUnit_Framework_TestCase;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
class DataValidatorProcessTest extends PHPUnit_Framework_TestCase
{
    public function testAddProcessorHasAFluentInterface()
    {
        $dataValidator = new DataValidator();

        $processor = function () {
        };

        assertThat(
            '`addProcessor` should return the `Graze\DataValidator\DataValidator` instance.',
            $dataValidator->addProcessor($processor),
            is($dataValidator)
        );
    }

    public function testProcessDoesNothingWithNoRegisteredProcessors()
    {
        $dataValidator = new DataValidator();

        assertThat(
            '`process` should return the given array of data if there are no registered processors.',
            $dataValidator->process(['foo' => 'bar']),
            is(anArray(['foo' => 'bar']))
        );
    }

    public function testProcessAppliesAllProcessors()
    {
        $dataValidator = new DataValidator();

        $dataValidator->addProcessor(function (array $data) {
            $data['one'] = 1;

            return $data;
        });

        $dataValidator->addProcessor(function (array $data) {
            $data['two'] = 2;

            return $data;
        });

        assertThat(
            '`process` should apply all registered processors to the given data array.',
            $dataValidator->process([]),
            is(anArray(['one' => 1, 'two' => 2]))
        );
    }
}
