<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <form wire:submit.prevent="confirmSubmitForm" method="POST" enctype="multipart/form-data">

        <div class="grid grid-cols-2 gap-8 items-stretch">


            <div class="flex flex-col justify-between  h-full">
                @if ($imagePreview)
                    <img src="{{ $imagePreview }}" class="h-64  object-cover border border-gray-300" alt="Vista previa">
                @elseif ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="h-64  object-cover border border-gray-300"
                        alt="Imagen actual">
                @else
                    <div class="flex-1 flex items-center h-64 justify-center w-full border-2 border-dashed rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                            <path d="M7 9l5 -5l5 5" />
                            <path d="M12 4l0 12" />
                        </svg>
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
                        value="" />
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
                    <select id="category" name="category" class="w-full rounded-md px-3 py-2"
                        wire:model.live="category">
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

                <div x-data class="mb-4">
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
