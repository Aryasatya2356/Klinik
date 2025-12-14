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
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>