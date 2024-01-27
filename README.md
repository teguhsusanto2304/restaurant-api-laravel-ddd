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

## Domain Driven Design (DDD) architecture

1. DiningTable
   - App\Modules\Http\Controllers\DiningTableController.php as Controller
   - App\Modules\DiningTable.php as Model
   - App\Modules\DiningTableDTO.php as Data Transfer Object
   - App\Modules\DiningTableReposetory.php as a gateway between Controller code and the persistence layer (database)
   - App\Modules\DiningTableReposetoryInterface.php as a layer of abstraction between the domain layer and the persistence layer
   - App\Modules\DiningTableService.php as a Service encapsulates business logic
   - App\Modules\DiningTableServiceInterface.php as a layer of abstraction between the service layer
3. Reservation
   - App\Modules\Http\Controllers\ReservationController.php as Controller
   - App\Modules\Reservation.php as Model
   - App\Modules\ReservationDTO.php as Data Transfer Object
   - App\Modules\ReservationReposetory.php as a gateway between Controller code and the persistence layer (database)
   - App\Modules\ReservationReposetoryInterface.php as a layer of abstraction between the domain layer and the persistence layer
   - App\Modules\ReservationService.php as a Service encapsulates business logic
   - App\Modules\ReservationServiceInterface.php as a layer of abstraction between the service layer

## Databse Structure
[Image] [https://github.com/teguhsusanto2304/restaurant-api-laravel-ddd/blob/main/documentation/erd.png]
## License

This project is licensed under the GPL-3.0 license.
