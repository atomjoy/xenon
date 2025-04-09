# App

Konfiguracja w .env lub .env.production a użytkownicy w database/seeders.

## Uruchom test

```sh
php artisan test --stop-on-failure

php artisan test --filter SampleTest --stop-on-failure
```

## Baza danych mysql

```sql
-- Tabele
CREATE DATABASE IF NOT EXISTS laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE DATABASE IF NOT EXISTS laravel_testing CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Nie wymagane do testu
GRANT ALL PRIVILEGES ON *.* TO root@localhost IDENTIFIED BY 'toor' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO root@127.0.0.1 IDENTIFIED BY 'toor' WITH GRANT OPTION;
```

## Produkcja

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

## Uruchom

```sh
npm run build
php artisan serve
```

## Resource Controller

```sh
php artisan make:model Category -a --resource

Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
```

## Links

```sh
# Icons
https://www.svgrepo.com/collection/kalai-oval-interface-icons
https://www.svgrepo.com/collection/solar-linear-icons/
```

## Product variants (many to many)

```sh
Products (id, name, desc, visible)
# 1, Shirt, Description, true
# 2, Laptop, Description, true

Skus (id, price, slug, product_id, stock_qty, on_stock = true)
# 1, 5.00, 'sku-100', 1, 55 // S-Blue
# 2, 6.00, 'sku-200', 1, 66 // S-Red
# 3, 7.00, 'sku-300', 1, 77 // M-Blue
# 4, 8.00, 'sku-400', 1, 88 // M-Red
# 10, 500, 'sku-501', 2, 3  // Intel-32GB
# 11, 600, 'sku-502', 2, 5  // Intel-64GB
# 12, 500, 'sku-601', 2, 8  // Amd-32GB
# 13, 600, 'sku-602', 2, 4  // Amd-64GB

Attributes (id, product_id, name)
# 1, 1, Size
# 2, 1, Color
# 3, 2, Procesor
# 4, 2, Ram
# 5, 2, Disk
# 6, 2, Graphics

Properties (id, attribute_id, name)
# 1, 1, S
# 2, 1, M
# 3, 2, Blue
# 4, 2, Red
# 5, 3, Intel
# 6, 3, Amd
# 7, 4, 32GB
# 8, 4, 64GB
# 9, 5, SSD
# 10, 5, HDD
# 11, 6, RTX4060
# 12, 6, RX7800

# Pivot table (or with 'property_id' not 'value')
attribute_sku (id, attribute_id, sku_id, value)
# 1,1,1,S
# 2,2,1,Blue
# 3,1,2,S
# 4,2,2,Red
# 5,1,3,M
# 6,2,3,Blue
# 7,1,4,M
# 8,2,4,Red
# 21,3,10,Intel
# 22,4,10,32GB
# 23,3,11,Intel
# 24,4,11,64GB
# 25,3,12,Amd
# 26,4,12,32GB
# 27,3,13,Amd
# 28,4,13,64GB
```
