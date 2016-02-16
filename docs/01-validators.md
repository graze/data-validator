# Validators

Register validators with an instance of `Graze\DataValidator\DataValidator` and validate your data arrays.

```php
use Graze\DataValidator\Adapter\RespectValidationAdapter;
use Graze\DataValidator\DataValidator;
use Respect\Validation\Validator;

$formValidator = new DataValidator();

// Let's check that we have a name and an age!
$validator = Validator::key('name', Validator::notBlank());
$formValidator->addValidator(new RespectValidationAdapter('name_required', $validator));

$validator = Validator::key('name', Validator::length(3));
$formValidator->addValidator(new RespectValidationAdapter('name_too_short', $validator));

$validator = Validator::key('age', Validator::intVal()->min(0));
$formValidator->addValidator(new RespectValidationAdapter('age_not_integer', $validator));

/** @var array */
$body = $request->getParsedBody();

/** @var array */
$errors = $formValidator->validate($body);

// We could then pass this back to a twig form.
return $twig->render('form.twig', [
    'form.errors' => $errors,
    'form.values' => $body,
]);
```

Here's some example usage with the twig template engine:

```twig
<form method="post" action="/submit">
    <div class="{{ form.errors.name_required or form.errors.name_too_short ? 'has-error' }}">
        <label for="name">name</label>
        <input type="text" name="name" value="{{ form.values.name }}" placeholder="name" required />
        {% if form.errors.name_required %}<small class="help-block">please enter a value</small>{% endif %}
        {% if form.errors.name_too_short %}<small class="help-block">your name should be at least 3 characters long</small>{% endif %}
    </div>

    <div class="{{ form.errors.age_required ? 'has-error' }}">
        <label for="age">age</label>
        <input type="number" name="age" value="{{ form.values.age }}" placeholder="age" required />
        {% if form.errors.age_not_integer %}<small class="help-block">this doesn't look like an age!</small>{% endif %}
    </div>

    <button type="submit">submit</button>
</form>
```
