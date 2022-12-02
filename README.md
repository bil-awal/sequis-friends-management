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

### Test Result
<img width="840" alt="Screenshot 2022-12-02 at 11 14 06 AM" src="https://user-images.githubusercontent.com/23447123/205213553-23f6eb83-2dc1-4f04-bc4e-92ded85e3e3d.png">

### API Documentation
1. `POST /api/v1/friendship {"email": "andy@example.com"}` - List of friends and common friends
<img width="1680" alt="Screenshot 2022-12-02 at 11 07 48 AM" src="https://user-images.githubusercontent.com/23447123/205212812-f495b981-dd17-4f77-b432-da6d4bb65e97.png">

2. `POST /api/v1/friendship/request {"requestor": "andy@example.com", "to": "john@example.com"}`- Send a friend request
<img width="1680" alt="Screenshot 2022-12-02 at 10 58 58 AM" src="https://user-images.githubusercontent.com/23447123/205211869-37e830cd-de77-4112-a38e-6524429552db.png">

3. `POST /api/v1/friendship/request/list {"email": "john@example.com"}` - List all friend requests
<img width="1680" alt="Screenshot 2022-12-02 at 11 09 58 AM" src="https://user-images.githubusercontent.com/23447123/205213027-2a5fea5c-14c6-4683-9e75-1d610f3a090c.png">

4. `POST /api/v1/friendship/request/block {"requestor": "andy@example.com", "block": "john@example.com"}` - Block a friend request
<img width="1680" alt="Screenshot 2022-12-02 at 11 08 39 AM" src="https://user-images.githubusercontent.com/23447123/205212910-12b4547b-99d5-4f29-9409-4b2eb4002cfc.png">

5. `POST /api/v1/friendship/accept  {"requestor": "andy@example.com", "to": "john@example.com"} ` - Accept a friend request
<img width="1680" alt="Screenshot 2022-12-02 at 11 00 32 AM" src="https://user-images.githubusercontent.com/23447123/205212059-68e97a46-de41-471c-9d89-12f1d9a2e36e.png">

6. `POST /api/v1/friendship/reject {"requestor": "andy@example.com", "to": "john@example.com"}` - Reject a friend request
<img width="1680" alt="Screenshot 2022-12-02 at 11 01 52 AM" src="https://user-images.githubusercontent.com/23447123/205212247-15cc44ab-2dca-48dd-a8ff-738da18da7e5.png">

7. `POST /api/v1/friendship/pending {"requestor": "andy@example.com", "to": "john@example.com"}` - Reset a friend request
<img width="1680" alt="Screenshot 2022-12-02 at 11 04 01 AM" src="https://user-images.githubusercontent.com/23447123/205212466-ef19e367-adb0-4d48-b5db-4ed443735f4a.png">


### References
- [Laravel: PHP Framework](https://laravel.com/)
- [Pest: PHP Testing](https://pestphp.com)

### License
This project is using Laravel and the framework are open-sourced software licensed under the license of MIT.
