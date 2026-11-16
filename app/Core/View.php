<?php
namespace App\Core;

/**
 * View - renders a PHP template inside the main layout.
 * View::render('products/index', ['products' => $list]);
 */
class View
{
    public static function render(string $view, array $data = []): string
    {
        $data['baseUrl'] = App::config('app.base_url');
        $data['user']    = $_SESSION['user'] ?? null;
        $data['cartCount'] = array_sum(array_column($_SESSION['cart'] ?? [], 'qty'));
        $data['flash']   = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        extract($data);

        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/../Views/layout.php';
        return ob_get_clean();
    }

    /** Escape output to prevent XSS. */
    public static function e($value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}
