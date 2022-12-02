# Sequis Friends Management
<img src="https://img.shields.io/badge/Web-v0.1-purple"> <img src="https://img.shields.io/badge/API-v0.1-purple"> <img src="https://img.shields.io/badge/PSR12-20221201 | OK-blue"> <img src="https://img.shields.io/badge/Composer-Build | PASS-success">

### 2022 © Bil Awal

For a social networking application, managing friendship is a shared characteristic. 

### The application features:
1. Friend Request
2. Approve Friend Request

### The application has:
1. API
2. Web

### The application uses:
1. PHP 8.1
2. MySQL 8.0
3. Laravel 9.4

### Installation
1. Clone the repository
2. Run `composer install`
3. Create a database
5. Run `php artisan migrate`
6. Run `php artisan test` - Test Driven
7. Run `php artisan serve` - Production Driven

### Docker Installation with Makefile
1. Clone the repository
2. Run `make install`
3. Run `make up`
4. Run `make migrate`
5. Run `make test` - Test Driven
6. Run `make serve` - Production Driven

### Application Structure
1. `app/Http/Controllers` - Contains all the controllers
2. `app/Http/Requests` - Contains all the requests
3. `app/Models` - Contains all the models
4. `app/Services` - Contains all the services
5. `app/Tests` - Contains all the tests

### API Documentation
1. `POST /api/v1/friendship {"email": "john@example.com"}` - List of friends and common friends
1. `POST /api/v1/friendship/request {"requestor": "andy@example.com", "to": "john@example.com"}`- Send a friend request
2. `POST /api/v1/friendship/request/list {"email": "john@example.com"}` - List all friend requests
3. `POST /api/v1/friendship/request/block {"requestor": "andy@example.com", "block": "john@example.com"}` - Block a friend request
4. `POST /api/v1/friendship/accept  {"requestor": "andy@example.com", "to": "john@example.com"} ` - Accept a friend request
5. `POST /api/v1/friendship/reject {"requestor": "andy@example.com", "to": "john@example.com"}` - Reject a friend request
6. `POST /api/v1/friendship/pending {"requestor": "andy@example.com", "to": "john@example.com"}` - Reset a friend request

### References
- [Laravel: PHP Framework](https://laravel.com/)
- [Pest: PHP Testing](https://pestphp.com)

### License
This project is using Laravel and the framework are open-sourced software licensed under the license of MIT.
