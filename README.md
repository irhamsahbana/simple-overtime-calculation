# Penggunaan

Berikut ini adalah adalah panduan untuk menggunakan aplikasi ini.

## Instalasi
Pada terminal di root folder project laravel jalankan command berikut:
1. `composer install`
2. `php artisan migrate:fresh --seed`
3. `php artisan serve`

## Endpoint
- **PATCH http://127.0.0.1:8000/api/settings**
  **parameters**
 -- id
 -- key
 -- value

- **GET http://127.0.0.1:8000/api/employees**

- **POST http://127.0.0.1:8000/api/employees**
**parameters**
 -- name
 -- status_id
 -- salary

- **GET http://127.0.0.1:8000/api/overtimes**

- **POST http://127.0.0.1:8000/api/overtimes**
**parameters**
 -- employee_id
 -- date (format: YYYY-MM-DD)
 -- time_started (format: HH:MM)
 -- time_ended ((format: HH:MM))

- **GET http://127.0.0.1:8000/api/overtime-pays/calculate**
**parameters**
 -- month (format: YYYY-MM)
