<div x-data class="">
    <div class="mt-6 grid sm:grids-cols-1 md:grid-cols-4 gap-4  ">
        @forelse ($products as $index => $product)
            <div wire:key="product-{{$product->id}}" class="relative flex flex-col h-full rounded-lg overflow-hidden border border-gray-300">

                @auth
                    @if($seller_id)
                        <button wire:click="updateProduct({{$product->id}})" class="absolute top-2 right-2 p-1 rounded-full bg-white/70 hover:bg-white shadow-md" title="Editar">
                            <x-svg-edit/>
                        </button>
                    @endif
                @endauth

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


    @if($page->hasMorePages())
        <div
            wire:key="sentinel-{{ $page->currentPage() }}"
            wire:loading.remove
            wire:target="loadMore" 
            x-intersect.once="$wire.loadMore()" 
            class=" py-4 text-center text-gray-600 mt-20"
        >
        </div>

        <div wire:loading.flex wire:target="loadMore" class="flex justify-center items-center w-full mt-8 py-4 text-center text-gray-600">
            <svg  xmlns="http://www.w3.org/2000/svg"  class="animate-spin h-8 w-8 text-slate-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 12a9 9 0 0 0 9 9a9 9 0 0 0 9 -9a9 9 0 0 0 -9 -9" />
                <path d="M17 12a5 5 0 1 0 -5 5" />
            </svg>
            Cargando más productos...
        </div>

    @else
        <div class=" mt-4 py-4 text-center text-gray-600">No hay más productos que mostrar</div>
    @endif


</div>
