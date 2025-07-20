<?php

namespace App\Livewire\Products;

use App\Models\CategoryProduct;
use Livewire\Component;

class ProductFilters extends Component
{
    public $productName = '';
    public $categoryId = null;
    public $categories;
    public $showCategories = true;

    public function mount($categoryId = null): void
    {
        $this->categories = CategoryProduct::pluck('name', 'id');
        $this->categoryId = $categoryId;

        if($this->categoryId){
            $this->showCategories = false;
        }
    }

    
    public function updated(): void
    {
        $categoryId = is_numeric($this->categoryId) ? (int) $this->categoryId : null;

        $this->dispatch('productFiltersUpdatedEvent', 
            productName: $this->productName,
            categoryId : $categoryId,
        );
    }


    public function render()
    {
        return view('livewire.products.product-filters');
    }
}
