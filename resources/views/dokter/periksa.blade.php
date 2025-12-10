<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pemeriksaan Medis: {{ $pendaftaran->no_antrian }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <div class="bg-gray-50 p-4 rounded mb-6 border">
                        <h3 class="font-bold text-lg mb-2">Data Pasien</h3>
                        <p><strong>Nama:</strong> {{ $pendaftaran->pasien->user->name }}</p>
                        <p><strong>Usia/Gender:</strong> {{ $pendaftaran->pasien->gender }}</p>
                        <p><strong>Keluhan:</strong> {{ $pendaftaran->keluhan }}</p>
                    </div>

                    <form action="{{ route('dokter.update', $pendaftaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700">Diagnosa Penyakit</label>
                            <textarea name="diagnosa" rows="2" class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500" required placeholder="Contoh: Infeksi Saluran Pernapasan Akut (ISPA)"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold text-gray-700">Tindakan / Catatan Dokter</label>
                            <textarea name="tindakan_dokter" rows="2" class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500" required placeholder="Contoh: Diberikan obat pereda nyeri, istirahat 3 hari."></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold text-gray-700 mb-2">Resep Obat (Bisa pilih lebih dari satu)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 bg-gray-50 p-3 rounded border h-40 overflow-y-auto">
                                @foreach($obats as $obat)
                                    <label class="flex items-center space-x-2 p-2 hover:bg-gray-100 rounded cursor-pointer">
                                        <input type="checkbox" name="resep_obat[]" value="{{ $obat->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-sm">{{ $obat->nama_obat }} (Rp {{ number_format($obat->harga) }})</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 mt-1">*Centang obat yang diperlukan.</p>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('dokter.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                💾 Simpan & Selesaikan Pemeriksaan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>