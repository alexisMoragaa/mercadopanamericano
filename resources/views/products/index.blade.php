<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @livewire('categories.categories')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center">
                        <h3 class="text-xl">{{ __('Recommended Products') }} </h3>
                        <a class="flex selft-end text-blue-500 hover:text-sky-800 hover:underline" href="{{route('products.all')}}" title="Ver todos los productos">
                            {{__('Show All')}}
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" /></svg>
                        </a>
                    </div>

                    @livewire('products.recomended-products')
                    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>






