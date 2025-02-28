# A Laravel SDK for the Float.com API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-float-sdk.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-float-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-float-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/laravel-float-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-float-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/spatie/laravel-float-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-float-sdk.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-float-sdk)

This package provides a seamless integration with the Float.com API for Laravel applications.
## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-float-sdk.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-float-sdk)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-float-sdk
```

Add the following environment variables to your .env file:

```dotenv
FLOAT_API_TOKEN=your_api_token_here
FLOAT_USER_AGENT=YourAppName (your-email@example.com)
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="float-sdk-config"
```

This is the contents of the published config file:

```php
return [
    'api_token' => env('FLOAT_API_TOKEN'),
    'user_agent' => env('FLOAT_USER_AGENT'),
];
```


## Usage

### Making API Requests

You can use the `FloatClient` to interact with the Float API. Here's an example of fetching all users:

```php
use Spatie\FloatSdk\FloatClient;
use Spatie\FloatSdk\Requests\GetUsers;

public function execute(FloatClient $client)
{
    $users = $client->users()->all();

    foreach ($users as $user) {
        echo $user->name;
    }
}
```


### Using the Facade

```php
use Spatie\FloatSdk\Facades\Float;

$users = Float::users()->all();

foreach ($users as $user) {
    echo $user->name;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Niels Vanpachtenbeke](https://github.com/Nielsvanpach)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
