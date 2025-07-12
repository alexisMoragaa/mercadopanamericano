<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public ?int $seller_id;

    public $filters = [
        'productName'  => '',
        'categoryId' => null,
    ];


    public function mount(?int $seller_id = null){
        $this->seller_id = $seller_id;
    }

    #[On('productFiltersUpdatedEvent')]
    public function productFiltersUpdatedEvent(string $productName, ?int $categoryId)
    {
        $this->filters = compact('productName', 'categoryId');
        $this->resetPage();
    }


    #[On('productListRefresh')]
    public function productListRefresh()
    {
        $this->resetPage();
    }


    public function updateProduct($productId)
    {
        $this->dispatch('updateProductEvent', 
            product: $productId,
        );
    }


    public function render()
    {
        $query = Product::query()
            ->when($this->filters['productName'], fn($query, $value) => $query->where('name', 'like',"%{$value}%"))
            ->when($this->filters['categoryId'], fn($query, $value) => $query->where('category_product_id', $value))
            ->when($this->seller_id, fn($query, $value) =>  $query->where('user_id', $value))
            ->orderBy('created_at', 'desc');

        $products = $query->paginate(10);

 
        return view('livewire.products.product-list', compact('products'));
    }
}
