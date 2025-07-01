<x-app-layout>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Estamos dentro si


                    
                    <x-primary-button  x-data=""
                        x-on:click.prevent="$dispatch('open-modal', {name: 'add-product', title: 'Añadir Producto'})"
                        >
                        {{ __('Add Productes') }}
                    </x-primary-button>

                    <x-modal-persist name="add-product" :show="$errors->isNotEmpty()" focusable>
                        <div class="p-4">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos consequatur nulla ratione quibusdam, dolor tempore quas alias autem et voluptatibus unde ipsam repellendus aliquam delectus nesciunt non modi? Possimus, velit.
                        </div>
                    </x-modal-persist>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
