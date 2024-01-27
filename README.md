# Restaurant API

This is a Restauran API build-in Laravel-based RESTful API that manages dining table and reservation using Domain Driven Design (DDD) architecture. The API allows users,dining table and reservation to create, read, update, and delete tasks.

## Table of Contents

-   Installation
-   Usage
-   Endpoints
-   Contributing
-   License

## Installation

Clone the repository:

```bash
git clone https://github.com/teguh.git
```

Install dependencies using Composer:

```bash
cd restaurant-api-laravel-ddd
composer install
```

Create .env file:

```bash
cp .env.example .env
```

Configure the database connection in .env file.

Run the database migration:

```bash
php artisan migrate
```

## Usage

Start the artisan(a command-line tool) server:

```bash
php artisan serve
```

Use your preferred HTTP client to make requests to the API endpoints.

## Endpoints

The API has the following endpoints:

You can learn on API Document at 
[Postman Collection]
```bash
/documentation/Restaurant API documentation.postman_collection.json
```

## Stack of Technology
- Laravel 10
- Mysql 5
- Domain Driven Design (DDD) architecture

## License

This project is licensed under the GPL-3.0 license.
