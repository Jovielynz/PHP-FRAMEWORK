<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home', [
            'title'    => 'Home',
            'featured' => Product::featured(4),
        ]);
    }
}
