<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;

/** All routes here are protected by AuthMiddleware (see config/routes.php). */
class OrderController extends Controller
{
    public function checkoutForm(): void
    {
        if (empty($_SESSION['cart'])) {
            $this->flash('Your cart is empty.', 'error');
            $this->redirect('/products');
        }
        $this->view('orders/checkout', ['title' => 'Checkout', 'cart' => $_SESSION['cart']]);
    }

    public function checkout(): void
    {
        $address = trim((string) $this->request->input('address'));
        if ($address === '' || empty($_SESSION['cart'])) {
            $this->flash('Please enter a delivery address.', 'error');
            $this->redirect('/checkout');
        }

        $orderId = Order::place((int) $_SESSION['user']['id'], $_SESSION['cart'], $address);
        unset($_SESSION['cart']);
        $this->redirect('/orders/success/' . $orderId);
    }

    public function success(string $id): void
    {
        $this->view('orders/success', ['title' => 'Order Placed', 'orderId' => (int) $id]);
    }

    public function history(): void
    {
        $this->view('orders/history', [
            'title'  => 'My Orders',
            'orders' => Order::forUser((int) $_SESSION['user']['id']),
        ]);
    }
}
