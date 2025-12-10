<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Obat</h2></x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" value="{{ $obat->nama_obat }}" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ $obat->harga }}" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label>Stok</label>
                        <input type="number" name="stok" value="{{ $obat->stok }}" class="w-full border rounded p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>