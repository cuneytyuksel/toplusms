#  toplusmsapi SMS Notifications for Laravel 5.3

## Introduction

This is a simple Notifications channel for Laravel.


## Installation

First, you'll need to require the package with Composer:

```sh
composer require cuneytyuksel/toplusms
```

Aftwards, run `composer update` from your command line.

Then, update `config/app.php` by adding an entry for the service provider.

```php
'providers' => [
	// ...
    Sms\TopluSms\TopluSmsProvider::class,
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
            'from' => env('TOPLUSMS_FROM', null), // Can be ovverdiden with $message->from() 
        ]
    // ...
];
```

## Usage
### Routing sms notifications

In order to send sms messages, you need to specify recipient for each notifiable entity.
For instance in `app/user.php`
```php
    // ...
    public function routeNotificationForSms(){
        return $this->phone;
    }
    // ...
```
### Sending notification
### via Method
In your notification class you can define channel as: 
```php
    // ...
    public function via($notifiable)
    {
        return ['sms'];
    }
    // ...
```
### toSMS Method
You also need to define, `toSms` method. You can:
1. Send a simple string as:
```php
    // ...
    public function toSms($notifiable)
    {
        return "Hello World!";
    }
    // ...
```
2. Or define a from (sender) to override config:
 ```php
     // ...
     public function toSms($notifiable)
     {
        $message = new SmsMessage("Hello World");
        $message->from("5xxxxxxxxx");
        return $message;
     }
     // ...
 ```
