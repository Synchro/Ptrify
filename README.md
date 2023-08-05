<p align="center">
    <a href="https://github.com/Synchro/Ptrify"><img src="art/ptrify.jpg" height="300" alt="Synchro/Ptrify Logo"></a>
</p>
<p align="center">
        <a href="https://github.com/synchro/ptrify/actions"><img alt="GitHub Workflow Status (main)" src="https://github.com/synchro/ptrify/actions/workflows/tests.yml/badge.svg"></a>
        <a href="https://packagist.org/packages/synchro/ptrify"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/synchro/ptrify"></a>
        <a href="https://packagist.org/packages/synchro/ptrify"><img alt="Latest Version" src="https://img.shields.io/packagist/v/synchro/ptrify"></a>
        <a href="https://packagist.org/packages/synchro/ptrify"><img alt="License" src="https://img.shields.io/packagist/l/synchro/ptrify"></a>
</p>

------
# Ptrify
This package provides a simple utility class for converting IP addresses to the format needed for DNS PTR records as defined in [RFC1035](https://www.rfc-editor.org/rfc/rfc1035) and [RFC3596](https://www.rfc-editor.org/rfc/rfc3596#section-2.5). While this can be done manually, it's a slightly tricky process that's easy to get wrong. This package aims to make it easier to generate PTR records for both IPv4 and IPv6 addresses.

This class does not attempt to handle subnets or wildcards, such as those discussed in [RFC 4472](https://www.rfc-editor.org/rfc/rfc4472.html); It is intended for use with single IP addresses only.

> **Requires [PHP 8.1+](https://php.net/releases/)**

## Installation
Install with [Composer](https://getcomposer.org/):
```bash
composer require synchro/ptrify
```

## Usage
```php
use Synchro\Ptrify\Ptrify;

$ptr = Ptrify::ptrify('192.0.2.151');
//$ptr == '151.2.0.192.in-addr.arpa'

$ptr6 = Ptrify::ptrify('2001:db8:f00::12:34ff:fe56:789a');
//$ptr6 == 'a.9.8.7.6.5.e.f.f.f.4.3.2.1.0.0.0.0.0.0.0.0.f.0.8.b.d.0.1.0.0.2.ip6.arpa'
```

Passing an invalid IP address (either v4 or v6) will throw an `InvalidArgumentException`.

## Contributing
See [CONTRIBUTING.md](CONTRIBUTING.md) for information, including coding standards and how to run tests.

------
Logo image based on [this image of petrified wood](https://www.flickr.com/photos/petrifiedforestnps/49975052262/) by [Petrifed ForestNPS](https://www.flickr.com/photos/petrifiedforestnps/) under [CC BY 2.0](https://creativecommons.org/licenses/by/2.0/).

Package built from **Skeleton PHP** by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[MIT license](https://opensource.org/licenses/MIT)**.
