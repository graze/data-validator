# Processors

Transform data before (or after) validation by registering and applying processors to data arrays.

For example, let's build a processor to remove any items in the array we're not interested in.

```php
/**
 * The KeyExistsProcessor cleans up data by ensuring only the given keys exist in the data array.
 */
class KeyFilterProcessor
{
    /**
     * @var array
     */
    private $keys = [];

    /**
     * Creates a new instance of the KeyFilterProcessor class.
     *
     * @param array $keys
     */
    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function __invoke(array $data)
    {
        foreach ($data as $key => $value) {
            // Remove any items in the array that we're not expecting.
            if (! in_array($key, $this->keys)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
```

This can then be passed to an instance of `Graze\DataValidator\DataValidator` like so:

```php
$validator = new DataValidator();

// Register the processor.
$validator->addProcessor(new KeyFilterProcessor(['first_name']));

// Apply the processor.
$processed = $validator->process(['foo' => 'bar', 'first_name' => 'Sam']);
```
