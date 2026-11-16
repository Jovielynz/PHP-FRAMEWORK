<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Product;

class ProductController extends Controller
{
    /** GET /products  (optional ?category=Lips) */
    public function index(): void
    {
        $category = $this->request->input('category');
        $products = $category ? Product::byCategory($category) : Product::all();

        $this->view('products/index', [
            'title'      => 'Shop',
            'products'   => $products,
            'categories' => Product::categories(),
            'active'     => $category,
        ]);
    }

    /** GET /products/{id} */
    public function show(string $id): void
    {
        $product = Product::find((int) $id);
        if (!$product) {
            Response::notFound('That product does not exist.');
            return;
        }
        $this->view('products/show', ['title' => $product['name'], 'product' => $product]);
    }
}
