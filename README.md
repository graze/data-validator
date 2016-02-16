# graze/data-validator [![Build Status][ico-build]][travis] [![Latest Version][ico-package]][package] [![MIT Licensed][ico-license]][license]

<!-- Links -->
[travis]: https://travis-ci.org/graze/data-validator
[package]: https://packagist.org/packages/graze/data-validator
[license]: https://github.com/graze/data-validator/blob/master/LICENSE

<!-- Images -->
[ico-license]: https://img.shields.io/packagist/l/graze/data-validator.svg
[ico-package]: https://img.shields.io/packagist/v/graze/data-validator.svg
[ico-build]: https://img.shields.io/travis/graze/data-validator/master.svg

Validate data, decoupled from your front end presentation.

## Installation

We recommend installing this library with [Composer](https://getcomposer.org).

```bash
$ composer require graze/data-validator
```

## Usage

```php
use Graze\DataValidator\DataValidator;

$validator = new DataValidator();

// Add a processor to roughly capitalize first names.
$validator->addProcessor(function (array $data) {
    $data['first_name'] = ucfirst($data['first_name']);
    return $data;
});

// Add a validator to check against a 'reserved' list.
$validator->addValidator(function (array $data) {
    if (in_array($data['first_name'], ['Sam', 'John', 'Ray'])) {
        return 'reserved_name';
    }
});

/** @var array */
$processed = $validator->process(['first_name' => 'sam']);

/** @var array */
$failures = $validator->validate($processed);

var_dump($failures);
```

The above would output:

```
array(1) {
  ["reserved_name"]=>
  bool(true)
}
```

## License

The content of this library is released under the **MIT License** by **Nature Delivered Ltd**.

You can find a copy of this license at http://www.opensource.org/licenses/mit or in [`LICENSE`](./LICENSE.md).
