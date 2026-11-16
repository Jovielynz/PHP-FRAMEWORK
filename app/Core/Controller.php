<?php
namespace App\Core;

/**
 * Controller - base class every controller extends.
 */
abstract class Controller
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function view(string $view, array $data = []): void
    {
        Response::send(View::render($view, $data));
    }

    protected function redirect(string $path): void
    {
        Response::redirect($path);
    }

    /** Store a one-time message shown on the next page. */
    protected function flash(string $message, string $type = 'success'): void
    {
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
    }
}
