<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class RecomendedProducts extends Component
{


    public function render()
    {
        $products =  Product::orderByDesc('points')->limit(8)->get();
        return view('livewire.products.recomended-products', compact('products'));
    }
}
