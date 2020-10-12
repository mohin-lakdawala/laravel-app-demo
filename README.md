# Backend laravel app demo

This project is created using Laravel 8.

## To get started:

1. Clone this repository.
1. Copy `.env.example` to `.env`.
1. Run `composer install` in the project root.
1. Create a database called `laravel` and update the `.env` file with DB settings.
1. Run `php artisan key:generate` to generate the application key.
1. Run `php artisan jwt:generate` to generate the application key for JWT logins.
1. Run `php artisan migrate` to migrate all the tables that backend needs.
1. Run `php artisan serve` to start the backend server.

## Tests:

To test the application run the below command from the root of the project:
```bash
php artisan test
```

## TODOS:
Some improvements that can be done but left out in this iteration due to time constraints have been listed below:

1. More robust authentication system using `refreshToken` 
1. Use Docker for development
