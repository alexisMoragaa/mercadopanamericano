<x-app-layout>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid grid-cols-2">
                        <h2>Mis Productos</h2>

                        <x-primary-button x-data="" class="justify-self-end"
                            x-on:click.prevent="$dispatch('open-modal', {name: 'add-product', title: 'Añadir Producto'})">
                            {{ __('Add Product') }}
                        </x-primary-button>
                    </div>

                    <div class="mt-6 grid grid-cols-4 gap-4 ">

                        @forelse ($products as $product)
                            <div class="relative flex flex-col h-full rounded-lg overflow-hidden border border-gray-300">

                                <!----- icono de edición (esquina superior derecha) --->
                                <button
                                    class="absolute top-2 right-2 p-1 rounded-full bg-white/70 hover:bg-white shadow-md"
                                    title="Editar">
                                    <!-- Heroicons outline: pencil-square -->

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        class="h-5 w-5 text-gray-700" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </button>

                                <!-- imagen fija -->
                                <img src="{{ Storage::url($product->image_path) }}" alt="Product Image"
                                    class="h-36 w-full object-cover shrink-0">

                                <!-- contenido elástico -->
                                <div class="flex flex-col flex-1 justify-between p-3">
                                    <!-- título y descripción -->
                                    <div>
                                        <h3 class="text-lg font-semibold leading-tight">{{ $product->name }}</h3>
                                        <p class="text-gray-600 text-sm mt-1">{{ $product->description }}</p>
                                    </div>

                                    <!-- precio y categoría -->
                                    <div class="mt-4">
                                        <p class="text-gray-800 font-bold">
                                            ${{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </p>
                                        <span
                                            class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 mt-1">
                                            {{ $product->category->name }}
                                        </span>
                                    </div>
                                </div>

                                <!----- icono de WhatsApp (esquina inferior derecha) --->
                                <a href="#"
                                    class="absolute bottom-3 right-3 p-1 rounded-full bg-green-500 hover:bg-green-600 shadow-md"
                                    title="Contacto WhatsApp">
                                    <!-- Font Awesome Brands: whatsapp -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                        <path
                                            d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <p>No hay productos</p>
                        @endforelse

                    </div>


                    <x-modal-persist name="add-product" maxWidth="4xl" :show="$errors->isNotEmpty()" focusable>
                        <div class="p-4">
                            @livewire('Products.AddProduct')
                        </div>
                    </x-modal-persist>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
