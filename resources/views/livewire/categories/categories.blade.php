 <div class="mb-4 p-2 md:p-0">
    @vite('resources/js/Splide/CategorySplide.js')

    <div class="splide">
        <div class="splide__track">
            <div class="splide__list">
                @foreach ($categories as $category)
                    <div class="splide__slide relative h-56 rounded-lg overflow-hidden bg-cover bg-center"
                        style="background-image: url('{{ Storage::url($category->image_path) }}')"
                    >
                        <div class="flex flex-row justify-between p-4 align-end h-full">

                            <span class="self-end text-white text-lg md:text-xl font-semibold drop-shadow-lg bg-black/60 px-4 py-1 rounded-lg">
                                {{ $category->name }}
                            </span>
                            <a 
                                href="{{route('products.category', $category->id)}}" 
                                class="self-end inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                {{__('Show More')}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
