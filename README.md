# Fleet Management System
> A system to manage reservation of fleet.

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Built with Laravel, fleet management system is designed to rovide complete control and flexibility in reservation procedures.


## Installation

Clone the project into your local space, configure .env file with local database.

```sh
composer install
```

```sh
php artisan migrate --seeds
```

```sh
php artisan passport:install
```

```sh
php artisan config:cache
```

```sh
php artisan serve
```
*Serving with a server like nginx is preferred.

## Release History

* 1.0.0
    * Add: Reservation module

## Contributing

1. Fork it (<https://github.com/Khaledhesham/fleet-management>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

