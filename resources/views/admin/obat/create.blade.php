<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Obat</h2></x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('obat.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label>Stok Awal</label>
                        <input type="number" name="stok" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>