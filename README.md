# NeonLoot – Gaming Gear E-commerce on a Custom PHP Framework

A simple gaming-gear online store (dark red theme) built on a hand-made MVC PHP framework (IPT10 Final Project).

## Requirements
- PHP 8.0+ with PDO (mysql) and cURL extensions
- MySQL / MariaDB (XAMPP or WAMP works fine)

## Setup (XAMPP)
1. Copy the `neonloot` folder into `C:\xampp\htdocs\`.
2. Open phpMyAdmin → **Import** → choose `database/schema.sql` → Go.
   (This creates the `neonloot` database, tables and sample products.)
3. Open `config/config.php` and check the database user/password
   (XAMPP default: user `root`, empty password).
4. Set `'base_url' => '/neonloot/public'` in `config/config.php`.
5. Visit `http://localhost/neonloot/public/`

## Setup (PHP built-in server, no Apache)
```bash
cd neonloot
php -S localhost:8000 -t public
```
Keep `base_url` empty and visit http://localhost:8000

## Demo account
- Email: `demo@neonloot.com`
- Password: `password123`

## Folder structure
```
neonloot/
├── public/            # web root: index.php (front controller), css/, js/
├── app/
│   ├── Core/          # the framework: App, Router, Request, Response, View,
│   │                  # Controller, Model, Database, CurrencyApi, Middleware/
│   ├── Controllers/   # Home, Product, Cart, Auth, Order
│   ├── Models/        # Product, User, Order
│   └── Views/         # PHP templates + layout.php
├── config/            # config.php (settings), routes.php (URL map)
├── database/          # schema.sql
└── logs/              # requests.log written by LogMiddleware
```

## External API
Product prices are shown in PHP with an approximate USD value using the free
exchange-rate API `https://open.er-api.com/v6/latest/PHP` (no key required).
If the API is unreachable the site still works – only the USD hint is hidden.

## Logo & theme
`public/images/logo.svg` is an original controller logo. Colours live in `:root` at the top of
`public/css/style.css`; the `rgbflow` keyframe animation slides the red gradient across borders and buttons.

## Product photos
Product photos are free stock images from Pexels (https://www.pexels.com/license/),
loaded by URL from the `image` column in the `products` table. To use your own
photo, put the file in `public/images/` and set `image` to `/images/yourfile.jpg`.
If a photo cannot load, `public/images/placeholder.svg` is shown instead.
