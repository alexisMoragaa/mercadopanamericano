<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ?int $seller_id;
    public int $perPage = 8;
    public Collection $loadedProducts;

    public $filters = [
        'productName'  => '',
        'categoryId' => null,
    ];



    public function mount(?int $seller_id = null){
        $this->seller_id = $seller_id;
        $this->loadedProducts = collect();
    }


    #[On('productFiltersUpdatedEvent')]
    public function productFiltersUpdatedEvent(string $productName, ?int $categoryId)
    {
        $this->filters = compact('productName', 'categoryId');
        $this->resetPageWithFilters();
    }


    public function resetPageWithFilters()
    {
        $this->resetPage();
        $this->loadedProducts = collect();
    }


    #[On('productListRefresh')]
    public function productListRefresh()
    {
        $this->resetPageWithFilters();
    }



    public function updateProduct($productId)
    {
        $this->dispatch('updateProductEvent', 
            product: $productId,
        );
    }


    public function loadMore()
    {
        $this->nextPage();
    }


    public function render()
    {
        $page = Product::query()
            ->when($this->filters['productName'], fn($query, $value) => $query->where('name', 'like',"%{$value}%"))
            ->when($this->filters['categoryId'], fn($query, $value) => $query->where('category_product_id', $value))
            ->when($this->seller_id, fn($query, $value) =>  $query->where('user_id', $value))
            ->orderBy('id', 'desc')
            ->simplePaginate($this->perPage);

        $this->loadedProducts = $this->loadedProducts
            ->merge($page->items())
            ->unique('id');

        return view('livewire.products.product-list', [
            'products' => $this->loadedProducts,
            'page'     => $page,            // para hasMorePages()
        ]);
    }
}
