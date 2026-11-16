<?php
/**
 * config/routes.php - every URL the application answers to.
 */
use App\Core\Router;
use App\Core\Middleware\AuthMiddleware;
use App\Core\Middleware\LogMiddleware;

$router = new Router();

// Global middleware: log every request
$router->use(LogMiddleware::class);

// Public pages
$router->get('/',               'HomeController@index');
$router->get('/products',       'ProductController@index');
$router->get('/products/{id}',  'ProductController@show');

// Cart (session based, no login needed)
$router->get('/cart',           'CartController@index');
$router->post('/cart/add',      'CartController@add');
$router->post('/cart/remove',   'CartController@remove');

// Authentication
$router->get('/login',          'AuthController@loginForm');
$router->post('/login',         'AuthController@login');
$router->get('/register',       'AuthController@registerForm');
$router->post('/register',      'AuthController@register');
$router->get('/logout',         'AuthController@logout');

// Orders - protected by AuthMiddleware
$router->get('/checkout',            'OrderController@checkoutForm', [AuthMiddleware::class]);
$router->post('/checkout',           'OrderController@checkout',     [AuthMiddleware::class]);
$router->get('/orders/success/{id}', 'OrderController@success',      [AuthMiddleware::class]);
$router->get('/orders',              'OrderController@history',      [AuthMiddleware::class]);

return $router;
