<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email Address')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="role" :value="__('Peran (Role)')" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-[#A4C96A] focus:ring-[#A4C96A] rounded-md shadow-sm">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="dokter" {{ $user->role == 'dokter' ? 'selected' : '' }}>Dokter</option>
                                <option value="perawat" {{ $user->role == 'perawat' ? 'selected' : '' }}>Perawat</option>
                                <option value="pasien" {{ $user->role == 'pasien' ? 'selected' : '' }}>Pasien</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="password" :value="__('Password Baru (Opsional)')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-[#004E64] hover:bg-[#00384a]">
                                {{ __('Update User') }}
                            </x-primary-button>
                            <a href="{{ route('user.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-bold">Batal</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>