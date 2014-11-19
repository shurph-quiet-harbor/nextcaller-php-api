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

## Usage

Example
-------
```php
<?php
$user = "XXXXX";
$password = "XXXXX";
$phoneNumber = "121212...";
$client = new NextCallerClient($user, $password);
$profiles = $client->getProfileByPhone($phoneNumber);
var_dump($profiles);
```


NextCallerClient
-------------

```php
<?php
$user = "XXXXX";
$password = "XXXXX";
$client = new \NextCaller\NextCallerClient($user, $password);
```

Parameters:
$user - api key;
$password - api secret;


### Get profile by phone ###

```php
<?php
$client = new \NextCaller\NextCallerClient("XXXXX", "XXXXX");
$profiles = $client->getProfileByPhone($phoneNumber);
```

Parameters:
$phoneNumber - phone number;

### Get profile by id ###

```php
<?php
$client = new \NextCaller\NextCallerClient("XXXXX", "XXXXX");
$profiles = $client->getProfile($id);
```

Parameters:
$id - id of a profile;


### Update profile ###

```php
<?php
$client = new \NextCaller\NextCallerClient("XXXXX", "XXXXX");
$response = $client->setProfile($id, $data);
```

Parameters:
$id - id of a profile;
$data - data to update.

## Testing

```bash
$ phpunit --bootstrap vendor/autoload.php tests/NextCallerMocker
```
