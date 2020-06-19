# A PHP package to get german holidays from feiertage-api.de

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devlabor/german-holidays.svg?style=flat-square)](https://packagist.org/packages/devlabor/german-holidays)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/devlabor/german-holidays/run-tests?label=tests)](https://github.com/devlabor/german-holidays/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/devlabor/german-holidays.svg?style=flat-square)](https://packagist.org/packages/devlabor/german-holidays)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require devlabor/german-holidays
```

## Usage

``` php
$holidays = DevLabor\GermanHolidays\Holidays::get();
$holidays = DevLabor\GermanHolidays\Holidays::get(2021, DevLabor\GermanHolidays\Holidays::STATE_SAXONY_ANHALT);

$federalKey =  DevLabor\GermanHolidays\Holidays::resolveFederalStateName('Sachsen-Anhalt'); // returns ST
$holidays = DevLabor\GermanHolidays\Holidays::get(null, $federalKey);
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@devlabor.be instead of using the issue tracker.

## Credits

- [:author_name](https://github.com/Kiv4h)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
