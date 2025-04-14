# A Laravel SDK for the Float.com API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-float-sdk.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-float-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-float-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/laravel-float-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-float-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/spatie/laravel-float-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-float-sdk.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-float-sdk)

A Laravel-friendly SDK to interact with the [Float API (v3)](https://developer.float.com/).

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

### Instantiating the Client

You can use the `FloatClient` class to interact with the Float API.
Why is it called `FloatClient` and not just `Float`, you ask? Well, float is a reserved keyword in PHP.

The `FloatClient` is bound to the Laravel service container and can be injected:

```php
use Spatie\FloatSdk\FloatClient;

public function __construct(protected FloatClient $client) {}

public function index()
{
    $users = $this->client->users()->all();
}

```

### Available endpoints

The `FloatClient` exposes the following resource groups:
- users()
- projects()
- tasks()

Each group has methods to fetch individual records or lists with optional filters.

### Users

#### Get user by ID

```php
$user = $client->users()->get(1);
```

#### Get all users

```php
// Without filters
$users = $client->users()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetUsersParameters;

$users = $client->users()->all(
    new GetUsersParameters(
        active: true,
        departmentId: 5,
    )
);
```

### Projects

####  Get project by ID

```php
$project = $client->projects()->get(10);
```

####  Get all projects

```php
// Without filters
$projects = $client->projects()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetProjectsParameters;

$projects = $client->projects()->all(
    new GetProjectsParameters(
        clientId: 10,
        tagName: 'Design',
        fields: ['id', 'name'],
        expand: ['client'],
    )
);
```

### Tasks

#### Get task by ID

```php
$task = $client->tasks()->get(1);
```

#### Get all tasks

```php
// Without filters
$tasks = $client->tasks()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetTasksParameters;

$tasks = $client->tasks()->all(
    new GetTasksParameters(
        projectId: 42,
        billable: true,
        fields: ['id', 'name'],
    )
);
```

### Pagination & Sorting

You can pass a parameter object to the `all()` methods. All parameters are optional.

- `page` (int): Page number (default: 1)
- `perPage` (int): Number of items per page (default: 50)
- `sort` (string): Sort field (e.g., "name", "modified_since")

```php
new GetUsersParameters(
    page: 2,
    perPage: 25,
    sort: 'name'
);
```

### Selecting fields

Limit which fields are returned by passing the `fields` array:

```php
new GetProjectsParameters(
    fields: ['id', 'name', 'client_id']
);
```

### Expanding relationships

Some endpoints support expanding related data using the `expand` array:
```php
new GetProjectsParameters(
    expand: ['client']
);

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
