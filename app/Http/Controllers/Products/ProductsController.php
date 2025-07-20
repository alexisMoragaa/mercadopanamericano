<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;

class ProductsController extends Controller
{

    public function index()
    {
        return view('products.index');
    }


    public function showAll()
    {
        return view('products.all-products');
    }

    public function filterByCategory(CategoryProduct $category)
    {
        return view('products.products-by-category', compact('category'));
    }
}

