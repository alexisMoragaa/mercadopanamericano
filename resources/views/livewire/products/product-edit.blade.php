<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form wire:submit.prevent="confirmSubmitForm" method="POST" enctype="multipart/form-data">

        <div class="grid grid-cols-2 gap-8 items-stretch">


            <div class="flex flex-col justify-between  h-full">

                @if ($imagePreview)
                    <img src="{{ $imagePreview }}" class="h-64  object-cover border border-gray-300" alt="Imagen del producto">
                @else
                    <div class="flex-1 flex items-center h-64 justify-center w-full border-2 border-dashed rounded-lg">
                        <x-svg-load-file/>
                    </div>
                @endif

                <div class="w-full mt-4">
                    <label for="image" class="block mb-2 text-sm text-slate-600">
                        {{ __('Select an Image') }}
                    </label>
                    <input id="image" type="file" wire:model="image" accept=".png, .jpg, .jpeg"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                          cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500
                          focus:border-indigo-500 px-3 py-1">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Campos del formulario --}}
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="nameProduct" class="block mb-2 text-sm text-slate-600">{{ __('Product Name') }}</label>
                    <input type="text" wire:model="nameProduct"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        value="{{$nameProduct}}" />
                    @error('nameProduct')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="description"
                        class="block mb-2 text-sm text-slate-600">{{ __('Product Description') }}</label>
                    <textarea type="text" wire:model="description"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                    </textarea>
                    @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block mb-2 text-sm text-slate-600">{{ __('Category Product') }}</label>
                    <select id="category" name="categoryId" class="w-full rounded-md px-3 py-2"
                        wire:model.defer="categoryId">
                        <option value="">Seleccione una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div x-data class="">
                    <label for="price" class="block mb-2 text-sm text-slate-600">{{ __('Price') }}</label>
                    <input id="price" type="text" inputmode="numeric" wire:model.defer="price"
                        x-on:input="
                            let digits = $event.target.value.replace(/\D/g, '');
                            let formatted = digits
                            ? new Intl.NumberFormat('es-CL', { maximumFractionDigits: 0 }).format(Number(digits))
                            : '';
                            $event.target.value = formatted;
                        "
                        class="w-full bg-transparent placeholder:text-slate-400 
                            text-slate-700 text-sm border border-slate-200 
                            rounded-md px-3 py-2 transition duration-300 ease 
                            focus:outline-none focus:border-slate-400 hover:border-slate-300 
                            shadow-sm focus:shadow" />
                    @error('price')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


            </div>

        </div>

        <div class="grid">
            <x-primary-button x-data="" class="mt-8 justify-self-end">
                {{ __('Save') }}
            </x-primary-button>
        </div>

    </form>
</div>
