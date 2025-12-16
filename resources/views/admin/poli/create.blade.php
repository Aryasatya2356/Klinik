<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Poli Baru</h2></x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('poli.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Nama Poli</label>
                        <input type="text" name="nama_poli" class="w-full border rounded p-2" required placeholder="Contoh: Poli Mata">
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded p-2" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="biaya_jasa" :value="__('Biaya Jasa Dokter')" />
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="biaya_jasa" id="biaya_jasa" 
                                class="block w-full rounded-md border-gray-300 pl-10 focus:border-[#A4C96A] focus:ring-[#A4C96A] sm:text-sm" 
                                placeholder="0" value="{{ old('biaya_jasa', 50000) }}" required>
                        </div>
                        <x-input-error :messages="$errors->get('biaya_jasa')" class="mt-2" />
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>