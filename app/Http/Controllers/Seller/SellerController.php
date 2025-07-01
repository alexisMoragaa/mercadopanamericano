<?php 

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    
    public function index()
    {
        return view('seller.index');
    }

    public function products()
    {
        return view('seller.products.index');
    }

    public function createProduct()
    {
        return view('seller.products.create');
    }

    public function editProduct($id)
    {
        return view('seller.products.edit', ['id' => $id]);
    }
}