Nextcaller php API
================================================


[![Build Status](https://travis-ci.org/Nextcaller/nextcaller-php-api.svg?branch=master)](https://travis-ci.org/Nextcaller/nextcaller-php-api)

A PHP wrapper around the Nextcaller API.

## Requirements

- [PHP](http://www.php.net) >= 5.3 **with** [cURL](http://www.php.net/manual/en/curl.installation.php)
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) >= 3.9.2

## Installation

You can install using [composer](#composer) or from [source](#source). Note that NextCaller is [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) compliant:

### Composer

If you don't have Composer [install](http://getcomposer.org/doc/00-intro.md#installation) it:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Require Nextcaller in your `composer.json`:

```javascript
{
  "require": {
     "nextcaller/nextcaller-php-api": "dev-master"
  }
}
```

Refresh your dependencies:

```bash
$ php composer.phar update
```


Then make sure to `require` the autoloader and initialize all:

```php
<?php
require(__DIR__ . '/vendor/autoload.php');
```

NextCallerClient
-------------

```php
<?php
require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerClient;

$user = "";
$password = "";
$phoneNumber = "XXXX";
$sandbox = true;

$client = new NextCallerClient($user, $password, $sandbox);
```

Parameters:
$user - username;
$password - password;
$sandbox - (boolean) is sandbox


### Get profile by phone ###

```php
<?php
$phoneNumber = 'XXXX';
$records = $client->getProfileByPhone($phoneNumber);
```

Parameters:
$phoneNumber - phone number;

### Get profile by id ###

```php
<?php
$id = 'XXXX';
$profile = $client->getProfile($id);
```

Parameters:
$id - id of a profile;


### Update profile ###

```php
<?php
$id = 'XXXX';
$data = array(
    "first_name"=> "Clark",
    "last_name"=> "Kent"
);
$response = $client->setProfile($id, $data);
```

Parameters:
$id - id of a profile;
$data - data to update.

### Get Fraud Level ###

```php
<?php
$phoneNumber = 'XXXX';
$platformUsername = 'XXXX';
$result =  $client->getFraudLevel($phoneNumber, $platformUsername);
```

Parameters:
$phoneNumber - id of a profile;
$platformUsername - data to update.


NextCallerPlatformClient
-------------

```php
<?php
require(__DIR__ . '/vendor/autoload.php');

use NextCaller\NextCallerPlatformClient;

$user = "XXXX";
$password = "XXXX";
$phoneNumber = "XXXX";
$sandbox = true;

$client = new NextCallerPlatformClient($user, $password, $sandbox);
```

Parameters:
$user - username;
$password - password;
$sandbox - (boolean) is sandbox


### Get profile by phone ###

```php
<?php
$phoneNumber = 'XXXX';
$platformUsername = 'XXXX';
$records = $client->getProfileByPhone($phoneNumber, $platformUser);
```

Parameters:
$phoneNumber - phone number;
$platformUsername - Platform username.

### Get profile by id ###

```php
<?php
$id = 'XXXX';
$platformUsername = 'XXXX';
$profile = $client->getProfile($id, $platformUser);
```

Parameters:
$id - id of a profile;
$platformUsername - Platform username.


### Update profile ###

```php
<?php
$id = 'XXXX';
$platformUsername = 'XXXX';
$data = array(
    "first_name"=> "Clark",
    "last_name"=> "Kent"
);
$response = $client->setProfile($id, $platformUser, $data);
```

Parameters:
$id - id of a profile;
$platformUsername - Platform username.
$data - data to update.

### Get Fraud Level ###

```php
<?php
$phoneNumber = 'XXXX';
$platformUsername = 'XXXX';
$result =  $client->getFraudLevel($phoneNumber, $platformUsername);
```

Parameters:
$phoneNumber - id of a profile;
$platformUsername - Platform username.

### Get Platform Statistic ###

```php
<?php
$result =  $client->getPlatformStatistics();
```

### Get Platform User ###

```php
<?php
$platformUsername = 'XXXX';
$platformUser = $client->getPlatformUser($platformUsername);
```

Parameters:
$platformUsername - Platform username.


### Update Platform User ###

```php
<?php
$platformUsername = 'XXXX';
$data = array(
    "first_name" => "XXXX"
);
$client->updatePlatformUser($platformUsername, $data);
```

Parameters:
$platformUsername - Platform username.
$data - Data for update.

## Errors handling 

### BadResponseException ###

In case of an incorrect answer received lib throws \NextCaller\Exception\BadResponseException.
Error data can be access with getError() method. 
Original request and response can be access with getRequest() and getResponse methods. 
```php
<?php
try {
    $records = $client->getProfileByPhone($phoneNumber);
} catch (\NextCaller\Exception\BadResponseException $e) {
    var_dump($e->getError());
    var_dump($e->getCode());
    var_dump($e->getMessage());
    $request = $e->getRequest();
    $response = $e->getResponse();
}
``` 

### FormatException ###

In case of an incorrect answer received and can't be parsed lib throws \NextCaller\Exception\FormatException.
Original request and response can be access with getRequest() and getResponse methods. 
```php
<?php
try {
    $records = $client->getProfileByPhone($phoneNumber);
} catch (\NextCaller\Exception\BadResponseException $e) {
    var_dump($e->getCode());
    var_dump($e->getMessage());
    $request = $e->getRequest();
    $response = $e->getResponse();
}
```

### Other Exceptions ###

In case of the library gets a response with the http code more or equal 400 (4xx codes), the \Guzzle\Http\Exception\ClientErrorResponseException exception is raised.

In case of the library gets a response with the http code more or equal 500 (5xx codes), the \Guzzle\Http\Exception\ServerErrorResponseException exception is raised.

If a request exceeds the configured number of maximum redirections, the \Guzzle\Http\Exception\TooManyRedirectsException exception is raised.

All exceptions inherit from the requests.exceptions.RequestException.
Guzzle\Http\Exception\BadResponseException

## Testing

```bash
$ phpunit --bootstrap vendor/autoload.php tests/NextCallerMocker
```
