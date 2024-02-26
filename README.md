# SDK for reqres API

This is SDK for [reqres API](https://reqres.in/).

Available resources:

- Users

This package is using [saloon](https://docs.saloon.dev/) for handling requests.

## Installation

You can install the package via composer:

```bash
composer require bpotmalnik/reqres-sdk
```

## Usage

### Getting users

To get users you might use following method of users resource:

```php
use Bpotmalnik\ReqresSdk\ReqresConnector;
use Illuminate\Support\LazyCollection;

/** @var LazyCollection $users */
$users = ReqresConnector::make()
    ->users()
    ->all();

$users->each(function(User $user){
    // access to user data object
});

or 

foreach($users as $user) {
    // access to user data object
}
```

This method will automatically handle pagination for you and
return [Laravel Lazy collection](https://josephsilber.com/posts/2020/07/29/lazy-collections-in-laravel)
for good DX. It can be also iterated an as array.

You can also specify how many users you want to get per page, how many pages you
want to get and what page you want to start from. All of those parameters are
optional as all method will handle pagination for you.

```php
use Bpotmalnik\Reqres\ReqresConnector;
use Bpotmalnik\Reqres\Data\User;

$users = ReqresConnector::make()
    ->users()
    ->all(
        perPage: 1, // how many records per page
        maxPages: 1, // how many pages you want to get
        startPage: 1, // from which page you want to start
    );

// it will get you one user from the first page
$users->each(function(User $user){
    // access to user data object
});
```

### Getting single user

To get a single user you might use following method of users resource:

```php
use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Data\User;

/** @var User $user */
$user = ReqresConnector::make()
    ->users()
    ->get(id: '1');
```

### Create a single user

To create single user you can use following method of users resource:

```php
use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Data\User;

/** @var User $user */
$user = ReqresConnector::make()
    ->users()
    ->create(
        name: 'test user',
        job: 'test job'
    );
```

### Accessing request data directly

If you need access request data for more information you can skip using
resources and manually execute
requests:

```php
use Bpotmalnik\ReqresSdk\ReqresConnector;
use Bpotmalnik\ReqresSdk\Requests\Users\GetUsers;

$users = ReqresConnector::make()
    ->send(new GetUsers);
```

For more information what is available on request you can
check [here](https://docs.saloon.dev/the-basics/responses)

### Error handling

Package will throw one of the following exceptions if there is an error:

```
SaloonException
├── FatalRequestException (Connection Errors)
└── RequestException (Request Errors)
├── ServerException (5xx)
│ ├── InternalServerErrorException (500)
│ ├── ServiceUnavailableException (503)
│ └── GatewayTimeoutException (504)
└── ClientException (4xx)
├── UnauthorizedException (401)
├── ForbiddenException (403)
├── NotFoundException (404)
├── MethodNotAllowedException (405)
├── RequestTimeOutException (408)
├── UnprocessableEntityException (422)
└── TooManyRequestsException (429)
```

More information [here](https://docs.saloon.dev/the-basics/handling-failures)

## Testing

```bash
composer test
```

Tests are using snapshot testing. If you want to update snapshots you can use
following command:

```bash
composer test-update-snapshots
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed
recently.

## Credits

- [Bart Potmalnik](https://github.com/bpotmalnik)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.
