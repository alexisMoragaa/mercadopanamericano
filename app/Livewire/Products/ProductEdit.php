<?php

namespace App\Livewire\Products;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public Product $product;

    public string $nameProduct, $description, $price;
    public int $categoryId;
    public $image;
    public ?string $imagePreview = null;

    
    public function confirmSubmitForm(){
        $this->dispatch('swal:confirmForm', [
            'type' => 'warning',
            'title' => '¿Estás segur@?',
            'text' => '¡Está acción actualizara el producto',
            'action' => 'updateProduct',
            'component' => $this->getId()
        ]);
    }



    #[On('updateProductEvent')]
    public function updateProductEvent(Product $product)
    {
        $this->product = $product;
        $this->nameProduct = $product->name;
        $this->description = $product->description;
        $this->categoryId = $product->category_product_id;
        $this->price = $product->price;

        $this->imagePreview = Storage::url($product->image_path);
        $this->image = null;

        $this->dispatch('open-modal', 
            name: 'edit-product',
            title: 'Actualizar Producto',
        );
    }


    public function updatedImage()
    {
        $this->validate([
            'image' => 'required|image|max:2024', // 2MB Max
        ]);

        $this->imagePreview = $this->image->temporaryUrl();
    }


    #[On('updateProduct')]
    public function updateProduct()
    {
        $this->validate([
            'nameProduct'   => 'required|string|max:255',
            'description'   => 'required|string|max:1000',
            'categoryId'    => 'required|exists:category_products,id',
            'price'         => 'required|numeric|min:0',
            'image'         => 'nullable|image|max:2024', // 2MB Max
        ]);

        if($this->image){
            $old = $this->product->image_path;
            $path = $this->image->store('products', 'public');
            $this->product->image_path = $path;

            if($old && Storage::disk('public')->exists($old)){
                Storage::disk('public')->delete($old);
            }
        }

        $this->product->update([
            'name'                 => $this->nameProduct,
            'description'          => $this->description,
            'category_product_id'  => $this->categoryId,
            'price'                => (int) str_replace('.', '', $this->price),
            'image_path'           => $this->product->image_path
        ]);


        $this->dispatch('productListRefresh');
        $this->dispatch('close-modal', name: 'edit-product');
        $this->dispatch('swal-info-message', 
            title:  '¡Producto actualizado!',
            message: 'Los cambios se guardaron correctamente.',
            type : 'success',
        );

    }


    public function render()
    {
        $categories = CategoryProduct::all();
        return view('livewire.products.product-edit', compact('categories'));
    }
}

