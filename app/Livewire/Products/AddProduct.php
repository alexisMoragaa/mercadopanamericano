<?php

namespace App\Livewire\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public $imagePreview;
    public $image;
    public $nameProduct;
    public $description;
    public $price;
    public $categories;
    public int $category;


    public function mount()
    {
        $this->categories = CategoryProduct::all();
    }


    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|max:2024', // 1MB Max
        ]);

        $this->imagePreview = $this->image->temporaryUrl();
    }


    public function saveProduct()
    {
        $this->validate([
            'nameProduct' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|exists:category_products,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2024', // 1MB Max
        ]);

        
        // Here you would typically save the product to the database
        Product::create([
            'name' => $this->nameProduct,
            'description' => $this->description,
            'price' => $this->price,
            'category_product_id' => $this->category,
            'image_path' => $this->image->store('products', 'public'),
        ]);

        session()->flash('message', 'Product added successfully!');

        // Reset fields after saving
        $this->reset(['imagePreview', 'image', 'nameProduct', 'description', 'price']);
    }

    public function render()
    {
        return view('livewire.products.add-product');
    }
}
