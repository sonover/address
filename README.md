# Sonover Address Module
Sonover Address is a [Concord module](https://artkonekt.github.io/concord/#/modules) that allows you to store addresses for an entity. 
Being a Concord module it is intended to be used by Laravel Applications.

## Installation
1. `composer require sonover/address`
2. If concord hasn't been installed yet, [install it](https://artkonekt.github.io/concord/#/installation)
3. Edit `config/concord.php` and add the address module:

```php
return [
    'modules' => [
        Sonover\Address\Providers\ModuleServiceProvider::class
    ]
];
```

After this, address should be listed among the concrd modules:

```
php artisan concord:modules -a

+----+-----------------------+--------+---------+------------------+-----------------+
| #  | Name                  | Kind   | Version | Id               | Namespace       |
+----+-----------------------+--------+---------+------------------+-----------------+
| 1. | Sonover Address Module | Module | 0.1.0   | sonover.address | Sonover\Address |
+----+-----------------------+--------+---------+------------------+-----------------+
```

## Usuage
```php
class Contact extends Model {
    use Addressable;
}
```

### Add an Address

```php
$contact->addAddress([
    'address' => 'Example',
    'city' => 'Example City',
    'province' => 'St. George',
    'country' => 'GD',
    'postalcode' => 'GD-142'
], 'shipping');
```

### Get all shipping addresses
```
$contact->shippingAddress
```

The following types are supported out of the box: `billing`, `business`, `contract`, `mailing`, `pickup`, `residential` and `shipping`

If you want to extend this list for your application refer to [Extending Enums](https://artkonekt.github.io/concord/#/enums?id=extending-enums) in Concord's documentation.

You can grab any address by the type `$contact->{type}Address`

### Remove Address
```php
$contact->removeAddress($address)
```