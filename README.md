# Laravel Ticketing Management System - Laravel `11.x`

**Demo:** http://localhost:8000

- Role Super Admin
```
Username - superadmin
password - secret
```

- Role Admin
```
Username - admin
password - secret
```

- Role Cashier
```
Username - cashier
password - secret
```

## Requirements:
- Laravel `11.x`
- Spatie role permission package  `^6.4`

## Project Setup
Git clone -
```console
git clone https://github.com/muslimiin/ticketing-systems.git
```

Go to project folder -
```console
cd ticketing-systems
```

Install Laravel Dependencies -
```console
composer install
```

Create database called - `ticketing_system`

Create `.env` file by copying `.env.example` file

Generate Artisan Key (If needed) -
```console
php artisan key:generate
```

Migrate Database with seeder -
```console
php artisan migrate:fresh --seed
```

Run Project -
```php
php artisan serve
```

So, You've got the project of Laravel Ticketing Management System on your http://localhost:8000

## API Event Documentation
Event API documentation can be seen in the api folder, inside which there is a Postman collection file in JSON format. Please download and import it into your Postman to view the Event API Documentation.

## Contribution
Contribution is open. Create Pull-request and I'll add it to the project if it's good enough.
