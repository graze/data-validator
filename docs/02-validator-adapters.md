# Validator Adapters

Create adapters for existing validation libraries! Included is a basic abstract class to create a new adapter,
see [`Graze\DataValidator\Adapter\AbstractExecutableAdapter`](../src/Adapter/AbstractExecutableAdapter.php), and an adapter for the `Respect\Validation` library.

When writing your own, ensure that the `validate` method returns a suitable string when validation fails.

For example in
[`Graze\DataValidator\Adapter\RespectValidationAdapter`](../src/Adapter/RespectValidationAdapter.php) we require a name
to be pass in when creating a new instance of the class, and calling the relevant methods
on the `Respect\Validation\Validatable` instance.
