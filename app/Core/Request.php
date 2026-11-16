<?php
namespace App\Core;

/**
 * Request - wraps the incoming HTTP request (URL, method, GET/POST data).
 */
class Request
{
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * Returns the URL path without the query string, e.g. "/products/3".
     * The base_url from config (e.g. "/neonloot/public" under XAMPP) is removed
     * so routes can always be written as "/products/{id}".
     */
    public function path(): string
    {
        $uri  = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH);

        $base = App::config('app.base_url', '');
        if ($base !== '' && strpos($path, $base) === 0) {
            $path = substr($path, strlen($base));
        }

        $path = rtrim($path, '/');
        return $path === '' ? '/' : $path;
    }

    /** Get a value from POST or GET, with a default. */
    public function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($_GET, $_POST);
    }

    public function isPost(): bool
    {
        return $this->method() === 'POST';
    }
}
