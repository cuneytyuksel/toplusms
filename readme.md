#  toplusmsapi SMS Notifications for Laravel 5.3

## Introduction

This is a simple Notifications channel for Laravel.


## Installation

First, you'll need to require the package with Composer:

```sh
composer require topcu/toplusmsşaravel
```

Aftwards, run `composer update` from your command line.

Then, update `config/app.php` by adding an entry for the service provider.

```php
'providers' => [
	// ...
    Topcu\TopluSms\TopluSmsProvider::class,
];
```

Then, update `config/services.php` by adding your toplusms credentials.

```php
return [
   // ...
	,
        'toplusms' => [
            'username' => env('TOPLUSMS_USERNAME'),
            'password' => env('TOPLUSMS_PASSWORD'),
            'from' => env('TOPLUSMS_FROM', null),
        ]
    // ...
];
```