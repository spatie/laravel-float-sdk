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

public function __construct(protected FloatClient $float) {}

public function index()
{
    $users = $this->float->users()->all();
}
```

### Available endpoints

The `FloatClient` exposes the following resource groups:
- users()
- projects()
- projectTasks()
- clients()
- allocations()
- timeOff()
- publicHolidays()

Each group has methods to fetch individual records or lists with optional filters.

### Users

#### Get user by ID

```php
$user = $float->users()->get(1);
```

#### Get all users

```php
// Without filters
$users = $float->users()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetUsersParams;

$users = $float->users()->all(
    new GetUsersParams(
        active: true,
        departmentId: 5,
    )
);
```

### Projects

####  Get project by ID

```php
$project = $float->projects()->get(10);
```

####  Get all projects

```php
// Without filters
$projects = $float->projects()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;

$projects = $float->projects()->all(
    new GetProjectsParams(
        clientId: 10,
        tagName: 'Design',
        fields: ['id', 'name'],
        expand: ['client'],
    )
);
```

### Project tasks

#### Get project task by ID

```php
$task = $float->projectTasks()->get(1);
```

#### Get all project tasks

```php
// Without filters
$tasks = $float->projectTasks()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetProjectTasksParams;

$tasks = $float->projectTasks()->all(
    new GetProjectTasksParams(
        projectId: 42,
        billable: true,
        fields: ['id', 'name'],
    )
);
```

### Clients

#### Get client by ID

```php
$client = $float->clients()->get(1);
```

#### Get all clients

```php
// Without filters
$clients = $float->clients()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetClientsParams;

$clients = $float->clients()->all(
    new GetClientsParams(
        fields: ['id', 'name'],
        expand: ['projects'],
    )
);
```

### Allocations

#### Get allocation by ID

```php
$allocation = $float->allocations()->get(1);
```

#### Get all allocations

```php
// Without filters
$allocations = $float->allocations()->all();

// With filters
use Spatie\FloatSdk\QueryParameters\GetAllocationsParams;

$allocations = $float->allocations()->all(
    new GetAllocationsParams(
        projectId: 10,
        startDate: '2025-01-01',
        endDate: '2025-12-31',
    )
);
```

### Time Off

#### Get all time off entries

```php
// Fetch time off entries within a date range
$timeOffs = $float->timeOff()->all('2025-01-01', '2025-12-31');
```

#### Get time off types

```php
$timeOffTypes = $float->timeOff()->types();
```

### Public Holidays

#### Get all public holidays

```php
// Fetch public holidays for a specific year
$holidays = $float->publicHolidays()->all(2025);
```

### Pagination & Sorting

You can pass a parameter object to the `all()` methods. All parameters are optional.

- `page` (int): Page number (default: 1)
- `perPage` (int): Number of items per page (default: 50)
- `sort` (string): Sort field (e.g., "name", "modified_since")

```php
use Spatie\FloatSdk\QueryParameters\GetUsersParams;

new GetUsersParams(
    page: 2,
    perPage: 25,
    sort: 'name'
);
```

### Selecting fields

Limit which fields are returned by passing the `fields` array:

```php
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;

new GetProjectsParams(
    fields: ['id', 'name', 'client_id']
);
```

### Expanding relationships

Some endpoints support expanding related data using the `expand` array:
```php
use Spatie\FloatSdk\QueryParameters\GetProjectsParams;

new GetProjectsParams(
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
