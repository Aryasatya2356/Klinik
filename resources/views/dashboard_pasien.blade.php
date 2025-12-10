<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>! <br>
                    Silakan pilih layanan di bawah ini.
                </div>
            </div>

            @if(isset($pendaftaranAktif))
                <div class="bg-indigo-600 text-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">🎫 Tiket Antrian Aktif</h3>
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div>
                                <p class="text-indigo-100">Nomor Antrian Anda:</p>
                                <p class="text-4xl font-extrabold">{{ $pendaftaranAktif->no_antrian }}</p>
                                <p class="text-sm mt-1">Poli: {{ $pendaftaranAktif->dokter->poli->nama_poli }} | Dokter: {{ $pendaftaranAktif->dokter->user->name }}</p>
                            </div>
                            <div class="mt-4 md:mt-0 text-center bg-white text-indigo-800 px-4 py-2 rounded-lg font-bold">
                                Status: {{ ucfirst(str_replace('_', ' ', $pendaftaranAktif->status)) }}
                            </div>
                        </div>
                        <p class="text-xs text-indigo-200 mt-4">*Silakan tunjukkan nomor ini ke Perawat saat tiba di klinik.</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:bg-blue-200 transition">
                    <h3 class="text-lg font-bold text-blue-800 mb-2">💊 Daftar Berobat</h3>
                    <p class="text-sm text-gray-600 mb-4">Ambil nomor antrian untuk pemeriksaan hari ini atau besok.</p>
                    <a href="{{ route('pasien.daftar') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded text-sm">Ambil Antrian</a>
                </div>

                <div class="bg-green-100 p-6 rounded-lg shadow-md hover:bg-green-200 transition">
                    <h3 class="text-lg font-bold text-green-800 mb-2">📋 Riwayat Medis</h3>
                    <p class="text-sm text-gray-600 mb-4">Lihat catatan hasil pemeriksaan dokter sebelumnya.</p>
                    <a href="{{ route('pasien.riwayat') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded text-sm">Lihat Riwayat</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>