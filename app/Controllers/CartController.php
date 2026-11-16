<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

/**
 * The cart is stored in the session as:  $_SESSION['cart'][productId] = [id, name, price, qty]
 */
class CartController extends Controller
{
    public function index(): void
    {
        $this->view('cart/index', ['title' => 'Your Cart', 'cart' => $_SESSION['cart'] ?? []]);
    }

    /** POST /cart/add */
    public function add(): void
    {
        $id      = (int) $this->request->input('product_id');
        $qty     = max(1, (int) $this->request->input('qty', 1));
        $product = Product::find($id);

        if ($product) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty'] += $qty;
            } else {
                $_SESSION['cart'][$id] = [
                    'id'    => $id,
                    'name'  => $product['name'],
                    'price' => (float) $product['price'],
                    'image' => $product['image'],
                    'qty'   => $qty,
                ];
            }
            $this->flash($product['name'] . ' added to your cart.');
        }
        $this->redirect('/cart');
    }

    /** POST /cart/remove */
    public function remove(): void
    {
        $id = (int) $this->request->input('product_id');
        unset($_SESSION['cart'][$id]);
        $this->flash('Item removed.');
        $this->redirect('/cart');
    }
}
