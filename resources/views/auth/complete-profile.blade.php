<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="grid">
                        <h2>Complete sus datos</h2>
                    </div>




                    <form method="POST" action="{{ route('complete-profile.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                autofocus autocomplete="name" :value="old('name', auth()->user()->name)" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                required autocomplete="email" :value="old('email', auth()->user()->email)" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Cellphone -->
                        <div class="mt-4" x-data>
                            <x-input-label for="cellphone" :value="__('Cellphone')" />

                            <div class="flex">
                                <!-- Prefijo fijo -->
                                <span
                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 bg-gray-50 text-gray-500 text-sm select-none">
                                    +569
                                </span>

                                <!-- Los 8 dígitos -->
                                <input id="cellphone" name="cellphone" type="tel" inputmode="numeric" maxlength="8"
                                    class="rounded-r-md border block w-full focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="12345678"
                                    :value="old(
                                        'cellphone',
                                        preg_replace('/^\+?569/', '', auth() - > user() - > cellphone ?? '')
                                    )"
                                    required pattern="^\d{8}$" x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '')"
                                    autocomplete="tel">
                            </div>

                            <p class="text-xs text-gray-500 mt-1">
                                Ingresa los 8 dígitos de tu celular (9 XXXX XXXX)
                            </p>

                            <x-input-error :messages="$errors->get('cellphone')" class="mt-2" />
                        </div>

                        {{-- Direccion --}}
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                required autocomplete="address" :value="old('address')" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>



                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">


                            <x-primary-button class="ms-4">
                                {{ __('Complete') }}
                            </x-primary-button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
