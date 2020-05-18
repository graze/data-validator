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

use Graze\DataValidator\DataValidator;
use Graze\DataValidator\DataValidatorInterface;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
class DataValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testShouldInitalize()
    {
        $dataValidator = new DataValidator();

        assertThat(
            '`Graze\DataValidator\DataValidator` should implement `Graze\DataValidator\DataValidatorInterface`.',
            $dataValidator,
            is(anInstanceOf(DataValidatorInterface::class))
        );
    }
}
