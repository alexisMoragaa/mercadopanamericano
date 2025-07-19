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
                            <x-primary-button class="self-end">{{__('Show More')}}</x-primary-button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
