<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Alamat Baru') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        @if(request('redirect'))
                            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                        @endif

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Nomor Telepon (WhatsApp)')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                                :value="old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address_line" :value="__('Alamat Lengkap (Jalan, No. Rumah, RT/RW)')" />
                            <x-text-input id="address_line" class="block mt-1 w-full" type="text" name="address_line"
                                :value="old('address_line')" required />
                            <x-input-error :messages="$errors->get('address_line')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('Kota / Kabupaten')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Province -->
                        <div class="mt-4">
                            <x-input-label for="province" :value="__('Provinsi')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province"
                                :value="old('province')" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>

                        <!-- Postal Code -->
                        <div class="mt-4">
                            <x-input-label for="postal_code" :value="__('Kode Pos')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                :value="old('postal_code')" required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan Alamat') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>