<?php
namespace App\Core;

/**
 * Response - helpers for sending output back to the browser.
 */
class Response
{
    public static function send(string $html, int $status = 200): void
    {
        http_response_code($status);
        echo $html;
    }

    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public static function redirect(string $path): void
    {
        $base = App::config('app.base_url');
        header('Location: ' . $base . $path);
        exit;
    }

    public static function notFound(string $message = 'Page not found'): void
    {
        http_response_code(404);
        echo View::render('404', ['message' => $message]);
    }
}
