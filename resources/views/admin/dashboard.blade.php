<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman Administrator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Selamat datang Admin! Kelola data klinik di sini.
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                    <h3 class="font-bold text-lg mb-2">👥 Kelola Pengguna</h3>
                    <p class="text-sm text-gray-600 mb-4">Tambah dokter, perawat, atau reset password.</p>
                    <a href="{{ route('user.index') }}" class="text-blue-500 hover:underline">Lihat Data &rarr;</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-red-500">
                    <h3 class="font-bold text-lg mb-2">💊 Kelola Obat</h3>
                    <p class="text-sm text-gray-600 mb-4">Update stok obat dan harga.</p>
                    <a href="{{ route('obat.index') }}" class="text-red-500 hover:underline">Lihat Data &rarr;</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
                    <h3 class="font-bold text-lg mb-2">🏥 Kelola Poli</h3>
                    <p class="text-sm text-gray-600 mb-4">Tambah poli baru atau layanan.</p>
                    <a href="{{ route('poli.index') }}" class="text-yellow-500 hover:underline">Lihat Data &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>