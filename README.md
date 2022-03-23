<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation steps
- clone the project.
- cd {projectName}
- sudo chmod -R 775 storage
- cp .env.example .env
- Change .env Database configurations
- composer install
- php artisan migrate --seed

## Weather application api
- Postman Collection link: https://documenter.getpostman.com/view/375068/UVsTp1sm
- Add new environment with variable (url:localhost:8000)

## Unit Testing
- To run unit testing : vendor/bin/phpunit

## Features
- The solution have 2 resources (cities, weather)
- cities resource (api/cities): have 2 endpoints one to list all cities and the other to show single city (I have already added default seeder with the default cities)
- weather resource: have 3 endpoints (Index. Show, Store)
- I have created also console command called "CallWeather" will be run 4 times a day (every 6 hours).
- I have created also Job called "CallWeatherAPI" will be called once the requested weather date is not in our datebase it will call the 3rd part Weather api

    - 
