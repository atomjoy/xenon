# Xenon Blog

Xenon is a Laravel and Vue based blog with multi-guard authentication.

## Run

Config in .env or .env.production and default users in database/seeders.

```sh
# Create storage and public_html links
php artisan storage:link
# DB Tables
php artisan migrate:fresh --seed
# Import mysql data
database/sql/laravel-8.sql
# Compile
npm run build
# Run
php artisan serve
```

## Login (guards)

Default user login details.

```sh
ClientPanel: /login
User: user@example.com
Pass: Password123#

AdminPanel: /admin/login
User: admin@example.com
Pass: Password123#
```

## Configs, Component json

```sh
# Json
resources/js/settings

# Seo schema
resources/js/utils/seo

# Lang
resources/js/lang
```

## Mysql table

```sql
-- Tabele
CREATE DATABASE IF NOT EXISTS laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE DATABASE IF NOT EXISTS laravel_testing CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Nie wymagane do testu
GRANT ALL PRIVILEGES ON *.* TO root@localhost IDENTIFIED BY 'toor' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO root@127.0.0.1 IDENTIFIED BY 'toor' WITH GRANT OPTION;
```

## Production

```sh
# Linki symboliczne
php artisan storage:link

# Baza danych
php artisan migrate --seed
php artisan migrate:fresh --seed

# Dodaj do cache
php artisan event:cache
php artisan config:cache
php artisan optimize

# Usuń z cache
php artisan event:clear
php artisan cache:clear
php artisan optimize:clear
```

## Compile, Run

```sh
npm run build
php artisan serve
```

## Resource Controller

```sh
php artisan make:model Category -a --resource

Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
```

## Test

```sh
php artisan migrate:fresh --seed

php artisan test --stop-on-failure

php artisan test --filter SampleTest --stop-on-failure
```

## TODO

```sh
- Single pages for: Team member, Project, Service
```

## Screenshots

<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/p1.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/p2.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/login-client.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/a2.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/b1.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/laravel-blog/refs/heads/main/screenshots/b3.png" width="100%">

## Links

```sh
# Icons
https://www.svgrepo.com/collection/kalai-oval-interface-icons
https://www.svgrepo.com/collection/solar-linear-icons/
```

## Licence

```txt
Private
```
