# Laravel feature test generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sofa/laravel-test-generator.svg?style=flat-square)](https://packagist.org/packages/jarektkaczyk/laravel-test-generator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jarektkaczyk/laravel-test-generator/run-tests?label=tests)](https://github.com/jarektkaczyk/laravel-test-generator/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/sofa/laravel-test-generator.svg?style=flat-square)](https://packagist.org/packages/jarektkaczyk/laravel-test-generator)


Don't write boilerplate for your feature tests! This package scans all the routes in your Laravel app and generates skeleton for testing them.

## Installation

You can install the package via composer:

```bash
composer require jarektkaczyk/package-laravel-test-generator-laravel
```

You can publish the config file with and customize it afterwards in `config/test_generator.php`:
```bash
php artisan vendor:publish --provider="Sofa\LaravelTestGenerator\LaravelTestGeneratorServiceProvider" --tag="config"
```

## Usage

``` php

```

## Roadmap

- [x] support for PHPUnit driver
    * [x] generate new test classes
    * [x] bare happy path case
    * [x] bare failing path case
    * [ ] parse route model binding and build setup for tests accordingly
    * [ ] (OPTIONAL) parse requests and build setup for tests accordingly - might be too complex in many cases
    * [ ] (OPTIONAL) update existing test classes with new methods (not trivial with `nette/php-generator`, find better way?)
- [x] support for different drivers
- [ ] other drivers

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email jarek@softonsofa.com instead of using the issue tracker.

## Credits

- [Jarek Tkaczyk](https://github.com/jarektkaczyk)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
