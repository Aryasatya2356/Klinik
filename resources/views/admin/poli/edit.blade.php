<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Edit Data Poli') }}
        </h2>
    </x-slot>

    <div class="py-12 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('poli.update', $poli->id) }}">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <x-input-label for="nama_poli" :value="__('Nama Poli')" />
                            <x-text-input id="nama_poli" class="block mt-1 w-full" 
                                          type="text" name="nama_poli" 
                                          :value="old('nama_poli', $poli->nama_poli)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_poli')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" rows="3" 
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-[#A4C96A] focus:ring-[#A4C96A]">{{ old('deskripsi', $poli->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="biaya_jasa" :value="__('Biaya Jasa Dokter')" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="biaya_jasa" id="biaya_jasa" 
                                    class="block w-full rounded-md border-gray-300 pl-10 focus:border-[#A4C96A] focus:ring-[#A4C96A] sm:text-sm" 
                                    placeholder="0" 
                                    value="{{ old('biaya_jasa', $poli->biaya_jasa) }}" required>
                            </div>
                            <x-input-error :messages="$errors->get('biaya_jasa')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button class="bg-[#004E64] hover:bg-[#00384a]">
                                {{ __('Update Data') }}
                            </x-primary-button>
                            
                            <a href="{{ route('poli.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>