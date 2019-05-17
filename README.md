# TWW

[![Latest Stable Version](https://img.shields.io/packagist/v/magroski/tww.svg?style=flat)](https://packagist.org/packages/magroski/tww)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat)](https://php.net/)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](https://github.com/magroski/tww/blob/master/LICENSE)

This library provides a quick and simple way to send messages using TWW

## Usage examples

```php
$client = new Client('user', 'pass');

$client->send('11 98888-1111', 'Happy Day', 123);
```
