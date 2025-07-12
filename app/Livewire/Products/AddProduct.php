<?php

namespace App\Livewire\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AddProduct extends Component
{
    use WithFileUploads;

    public $imagePreview;
    public $image;
    public $nameProduct;
    public $description;
    public $price;
    public int $category;


    public function confirmSubmitForm(){
        $this->dispatch('swal:confirmForm', [
            'type' => 'warning',
            'title' => '¿Estás segur@?',
            'text' => '¡Está acción creara un nuevo producto y lo dejara disponible en tu catalogo!',
            'action' => 'saveProduct',
            'component' => $this->getId()
        ]);
    }


    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|max:2024', // 2MB Max
        ]);

        $this->imagePreview = $this->image->temporaryUrl();
    }


    #[On('saveProduct')]
    public function saveProduct()
    {
        $this->validate([
            'nameProduct' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'required|exists:category_products,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2024', // 2MB Max
        ]);

        
        // Here you would typically save the product to the database
        Product::create([
            'name' => $this->nameProduct,
            'description' => $this->description,
            'price' => str_replace(".", "", $this->price),
            'category_product_id' => $this->category,
            'image_path' => $this->image->store('products', 'public'),
            'user_id' => Auth::user()->id, // Assuming the user is authenticated
        ]);


        // Reset fields after saving
        $this->reset(['imagePreview', 'image', 'nameProduct', 'description', 'price']);

        $this->dispatch('close-modal', name: 'add-product');
        $this->dispatch('swal-info-message', 
            title: 'Producto Creado',
            text: 'El producto ha sido creado exitosamente.',
            type: 'success',
        );
        $this->dispatch('productListRefresh');

    }

    public function render()
    {
        $categories = CategoryProduct::all();
        return view('livewire.products.add-product', compact('categories'));
    }
}
