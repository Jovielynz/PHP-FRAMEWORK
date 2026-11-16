<?php
namespace App\Core\Middleware;

use App\Core\Request;

/**
 * LogMiddleware - writes every request to logs/requests.log
 */
class LogMiddleware
{
    public function handle(Request $request): void
    {
        $line = sprintf("[%s] %s %s\n", date('Y-m-d H:i:s'), $request->method(), $request->path());
        file_put_contents(__DIR__ . '/../../../logs/requests.log', $line, FILE_APPEND);
    }
}
