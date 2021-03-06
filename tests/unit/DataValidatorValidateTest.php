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
class DataValidatorValidateTest extends PHPUnit_Framework_TestCase
{
    public function testAddValidatorShouldAddValidators()
    {
        $dataValidator = new DataValidator();

        $validator = function () {
            return 'always_fail';
        };

        $dataValidator->addValidator($validator);

        assertThat(
            '`addValidator` should add validators to the queue.',
            $dataValidator->validate([]),
            is(anArray(['always_fail' => true]))
        );
    }

    public function testAddValidatorHasAFluentInterface()
    {
        $dataValidator = new DataValidator();

        $validator = function () {
        };

        assertThat(
            '`addValidator` should return the `Graze\DataValidator\DataValidator` instance.',
            $dataValidator->addValidator($validator),
            is($dataValidator)
        );
    }

    public function testValidateReturnsAnEmptyArrayOnNoFailures()
    {
        $dataValidator = new DataValidator();

        assertThat(
            '`validate` should return an empty array when there are no queued validators.',
            $dataValidator->validate([]),
            is(anArray([]))
        );

        $dataValidator->addValidator(function (array $data) {
            return null;
        });

        assertThat(
            '`validate` should return an empty array when there are no failures from all queued validators.',
            $dataValidator->validate([]),
            is(anArray([]))
        );
    }

    public function testValidateRunsAllValidators()
    {
        $dataValidator = new DataValidator();

        $dataValidator->addValidator(function (array $data) {
            return 'always_fail_one';
        });

        $dataValidator->addValidator(function (array $data) {
            return 'always_fail_two';
        });

        assertThat(
            '`validate` should run the data against each registered validator.',
            $dataValidator->validate([1, 2, 3]),
            is(anArray(['always_fail_one' => true, 'always_fail_two' => true]))
        );
    }
}
