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

use Graze\DataValidator\Adapter\RespectValidationAdapter;
use Respect\Validation\Validatable as RespectValidatable;
use Respect\Validation\Validator;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidatorInterface;
use Zend\Validator\ValidatorInterface as ZendValidatorInterface;

/**
 * @author Samuel Parkinson <sam@graze.com>
 */
class RespectValidationAdapterTest extends PHPUnit_Framework_TestCase
{
    public function testShouldInitalize()
    {
        $respectValidator = Mockery::mock(RespectValidatable::class);
        $respectValidator->shouldReceive('setName');

        $validator = new RespectValidationAdapter('respect_validator', $respectValidator);

        assertThat($validator, is(callableValue()));
    }

    /**
     * @dataProvider invalidNameProvider
     * @expectedException InvalidArgumentException
     */
    public function testConstructorThrowsOnInvalidNameParameters($invalidName)
    {
        new RespectValidationAdapter($invalidName, Mockery::mock(RespectValidatable::class));
    }

    public function invalidNameProvider()
    {
        return [[null], [1], [[]], [0.0], [true], [new stdClass()]];
    }

    /**
     * @dataProvider validNameProvider
     */
    public function testConstructorAcceptsValidNamePrameters($validName)
    {
        $respectValidator = Mockery::mock(RespectValidatable::class);
        $respectValidator->shouldReceive('setName');

        $validator = new RespectValidationAdapter($validName, $respectValidator);

        assertThat($validator, is(callableValue()));
    }

    public function validNameProvider()
    {
        return [[''], ['foo'], ['foo_bar'], ['foo bar']];
    }

    public function testShouldPassThroughValidatorName()
    {
        $name = 'foo';

        $respectValidator = Mockery::mock(RespectValidatable::class);
        $respectValidator->shouldReceive('setName')->once()->with($name);
        $respectValidator->shouldReceive('getName')->once()->andReturn($name);
        $respectValidator->shouldReceive('validate')->once()->andReturn(false);

        $validator = new RespectValidationAdapter($name, $respectValidator);

        assertThat('The respect validation adapter should return the validator name on failed validations.',
            $validator([]), is($name));
    }

    public function testShouldWorkWithZendValidators()
    {
        $zendValidator = Mockery::mock(ZendValidatorInterface::class);
        $zendValidator->shouldReceive('isValid')->once()->andReturn(false);

        $respectValidator = Validator::key('test', Validator::zend($zendValidator));

        $validator = new RespectValidationAdapter('failed_validator', $respectValidator);

        assertThat('The respect validation adapter should work with Respects Zend validation rule.',
            $validator(['test' => 'foo']), is('failed_validator'));
    }

    public function testShouldWorkWithSymfonyValidators()
    {
        $respectValidator = Validator::key('test', Validator::sf('Time'));

        $validator = new RespectValidationAdapter('failed_validator', $respectValidator);

        assertThat('The respect validation adapter should work with Respects Symfony validation rule.',
            $validator(['test' => 'Not a time.']), is('failed_validator'));
    }
}
