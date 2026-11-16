<?php
namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;

/**
 * AuthMiddleware - blocks pages that require a logged-in user.
 */
class AuthMiddleware
{
    public function handle(Request $request): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['flash'] = ['message' => 'Please log in to continue.', 'type' => 'error'];
            Response::redirect('/login');
        }
    }
}
