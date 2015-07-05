# Entity
Part of [wnowicki/generic](../README.md)

Entity is a concept of simple data handling object which is using getters and setters to work with internal properties. Also provides `toArray()` method which returns object properties as an `array`.

### Setters
Methods name are build this way `setPropertyName()`. Camel case property name with prefix *set*.  
**Input** Setters are taking one param which is value of property.  
**Return** Setters must return instance of object itself. So they could be chained.

### Getters
Methods name are build this way `getPropertyName()`. Camel case property name with prefix *get*.  
**Input** Getters are taking no params.  
**Return** Getters are returning value of property or `null` if not set.

## Abstract Entity

### Implementation

```php
/**
 * Person Entity
 *
 * @method $this setFirstName(string $firstName)
 * @method string getFirstName()
 * @method $this setLastName(string $lastName)
 * @method string getLastName()
 */
class Person extends \WNowicki\Generic\AbstractEntity
{
    protected $properties = [
        'first_name',
        'last_name',
    ];
}
```

### Creating New object

```php
$tester = Person::make(
    [
        'first_name' => 'Jo',
        'last_name'  => 'Doe',
        'age'        => 35,
    ]
);
```
