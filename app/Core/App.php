<?php
namespace App\Core;

/**
 * App - loads configuration, registers the autoloader, and boots the router.
 */
class App
{
    private static array $config = [];

    public static function boot(): void
    {
        self::$config = require __DIR__ . '/../../config/config.php';

        // Simple PSR-4 style autoloader: App\Core\Router -> app/Core/Router.php
        spl_autoload_register(function (string $class) {
            $file = __DIR__ . '/../../' . str_replace(['App\\', '\\'], ['app/', '/'], $class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
        });

        if (self::config('app.debug')) {
            ini_set('display_errors', '1');
            error_reporting(E_ALL);
        }

        session_start();
    }

    /** Dot-notation getter: App::config('database.host') */
    public static function config(string $key, $default = null)
    {
        $value = self::$config;
        foreach (explode('.', $key) as $part) {
            if (!isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }
        return $value;
    }

    public static function run(): void
    {
        self::boot();
        $router = require __DIR__ . '/../../config/routes.php';
        $router->dispatch(new Request());
    }
}
