# Api Response Macros for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eozden/api-response.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/pushbullet)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/eozden/api-response/master.svg?style=flat-square)](https://travis-ci.org/eozden/api-response)
[![StyleCI](https://styleci.io/repos/:id/shield)](https://styleci.io/repos/:id)
[![Total Downloads](https://img.shields.io/packagist/dt/eozden/api-response.svg?style=flat-square)](https://packagist.org/packages/eozden/api-response)

![image](https://banners.beyondco.de/API%20Response.png?theme=light&packageName=eozden%2Fapi-response&pattern=aztec&style=style_1&description=Easily+create+rest+api+responses&md=1&showWatermark=1&fontSize=100px&images=briefcase&widths=200&heights=200)

This package makes it easy to create rest api responses for Laravel 5.5+, 6.x, 7.x and 8.x.

## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Available Macros](#available_macros)
    - [Sample Responses](#sample_responses)
    - [Examples](#examples)
    - [Config](#config)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation
Via Composer
```bash
$ composer require eozden/api-response
```
Or you can manually update your require block and run `composer update` if you choose so:
```json
{
    "require": {
        "eozden/api-response": "^1.0"
    }
}
```

## Usage

### Available macros

```php
response()->ok($data = null, int $code = null);
response()->error($data = null, int $code = null);
```

### Sample Responses

```json
{
  "success": true,
  "code": 200,
  "locale": "en",
  "message": "OK",
  "data": null
}
```

```json
{
  "success": false,
  "code": 422,
  "locale": "en",
  "message": "UNPROCESSABLE ENTITY",
  "data": null
}
```

### Examples

```php
public function delete()
{
    User::find(1)->delete();

    return response()->ok();
}
```

### Config

```php
return [

    /**
     * Default response code settings
     */ 
    "default" => [
        "ok" => \Eozden\ApiResponse\ResponseStatus::OK,
        "error" => \Eozden\ApiResponse\ResponseStatus::UNPROCESSABLE_ENTITY,
    ],
    
    /**
     * Force to use middleware to return response as a json
     */ 
    "force" => true,
    
    /**
     * You can add your custom HTTP Status Codes
     */ 
    "map" => [
        \Eozden\ApiResponse\ResponseStatus::OK => "ok",
        \Eozden\ApiResponse\ResponseStatus::CREATED => "created",
        \Eozden\ApiResponse\ResponseStatus::ACCEPTED => "accepted",
        \Eozden\ApiResponse\ResponseStatus::NO_CONTENT => "no_content",
        \Eozden\ApiResponse\ResponseStatus::NOT_MODIFIED => "not_modified",
        \Eozden\ApiResponse\ResponseStatus::BAD_REQUEST => "bad_request",
        \Eozden\ApiResponse\ResponseStatus::UNAUTHORIZED => "unauthorized",
        \Eozden\ApiResponse\ResponseStatus::FORBIDDEN => "forbidden",
        \Eozden\ApiResponse\ResponseStatus::NOT_FOUND => "not_found",
        \Eozden\ApiResponse\ResponseStatus::CONFLICT => "conflict",
        \Eozden\ApiResponse\ResponseStatus::UNPROCESSABLE_ENTITY => "unprocessable_entity",
        \Eozden\ApiResponse\ResponseStatus::INTERNAL_SERVER_ERROR => "internal_server_error"
    ]
];
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email enes@emarka.com.tr instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Enes Özden](https://twitter.com/ensozden)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
