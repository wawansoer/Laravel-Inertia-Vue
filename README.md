<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Repository

This is a full-stack project simple CRUD project with

-   Laravel
-   Inertia
-   Vue

## Prerequisites

Before you begin, make sure you have the following prerequisites installed:

-   PHP and Composer
-   Laravel CLI
-   Node.js and npm
-   MySQL

## How To Start The Project

-   Install dependency using composer by run this code :

    ```console
    composer install
    ```

-   Install dependency using NPM by run this code :

    ```console
    npm install
    ```

-   Set up your .env using this command :
    ```console
    cp .env.example .env
    ```
-   Make sure database connection configure correctly and run this code to generate tables :
    ```console
    php artisan key:generate
    ```
-   Make sure database connection configure correctly and run this code to generate tables :
    ```console
    php artisan migrate
    ```
-   Generate dummy data by using this command :
    ```console
    php artisan db:seed
    ```
-   Run Back End By using this :
    ```console
    php artisan serve
    ```
-   Run Front End By using this :
    ```console
    npm run dev
    ```
    or you can build the front end app by using :
    ```console
    npm run build
    ```
    if you build the Front End App you don't have to run _npm run dev_ to use thi application
-   Run this code to know what's inside this app :
    ```console
    php artisan route:list
    ```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
