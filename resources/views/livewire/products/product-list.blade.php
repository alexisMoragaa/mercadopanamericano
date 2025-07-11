<div>
    <div class="mt-6 grid grid-cols-4 gap-4 ">
        @forelse ($products as $index => $product)
            <div class="relative flex flex-col h-full rounded-lg overflow-hidden border border-gray-300">

                <button wire:click="updateProduct({{$product->id}})" class="absolute top-2 right-2 p-1 rounded-full bg-white/70 hover:bg-white shadow-md" title="Editar">
                   <x-svg-edit/>
                </button>

                <img src="{{ Storage::url($product->image_path) }}" alt="Product Image" class="h-36 w-full object-cover shrink-0">

                <!-- contenido elástico -->
                <div class="flex flex-col flex-1 justify-between p-3">

                    <div>
                        <h3 class="text-lg font-semibold leading-tight">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $product->description }}</p>
                    </div>

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

                <a href="#" class="absolute bottom-3 right-3 p-1 rounded-full bg-green-500 hover:bg-green-600 shadow-md" title="Contacto WhatsApp">
                   <x-svg-whatsapp/>
                </a>
            </div>
        @empty
            <p>No hay productos que mostrar</p>
        @endforelse
    </div>
</div>
