# To-Do Back-End API

An API to manage a toko-online api built with Laravel.

## Getting Started

### Prerequisites

```bash
php -v
pastikan version PHP 8.2.0 (dibawah versi ini kemungkinan error)
composer -V
Composer version 2.5.8 (dibawah versi ini kemungkinan error)
```
### Installing

Clone this repo.

```bash
git clone https://github.com/framadhan99/toko-online-api.git
```

Copy file .env.example to .env

```bash
cd laravel-todo-backend-api
create new file .env
copy .env.example to file .env
```

Install the project dependencies.

```bash
composer install
```

Create database and migrate.

```bash
create database name toko_api
in file .env DB_DATABASE=toko_api
php artisan migrate
```

Set the application key.

```bash
php artisan key:generate
```

Serve the application on the PHP development server.

```bash
php artisan serve
```

List all registered routes.

```bash
php artisan route:list
```

Enjoy!

## Built With

-   Laravel
