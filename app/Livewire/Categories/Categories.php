<?php

namespace App\Livewire\Categories;

use App\Models\CategoryProduct;
use Livewire\Component;

class Categories extends Component
{   
    public $categories;

    public function mount(){
        $this->categories = CategoryProduct::all();
    }

    public function render()
    {
        return view('livewire.categories.categories');
    }
}
