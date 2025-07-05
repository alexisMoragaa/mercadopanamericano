<x-app-layout>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid grid-cols-2">
                        <h2>Mis Productos</h2>

                        <x-primary-button  x-data=""
                            class="justify-self-end"
                            x-on:click.prevent="$dispatch('open-modal', {name: 'add-product', title: 'Añadir Producto'})"
                            >
                            {{ __('Add Product') }}
                        </x-primary-button>
                    </div>

                    <div class="m-2 p-3">
                        @livewire('Products.AddProduct')
                    </div>
                    
                    
                    <x-modal-persist name="add-product" maxWidth="4xl" :show="$errors->isNotEmpty()" focusable>
                        <div class="p-4">
                        </div>
                    </x-modal-persist>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
