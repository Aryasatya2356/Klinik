<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('dokter.dashboard') }}" class="text-gray-400 hover:text-[#004E64] transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
                Pemeriksaan Medis: {{ $pendaftaran->no_antrian }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                
                <div class="bg-[#004E64] px-6 py-4 text-white flex justify-between items-center">
                    <span class="font-bold tracking-wide">Formulir Diagnosa Dokter</span>
                    <span class="text-xs bg-white/20 px-2 py-1 rounded">{{ date('d M Y') }}</span>
                </div>

                <div class="p-8">
                    
                    <div class="bg-[#FBF8F1] p-5 rounded-xl border border-[#A4C96A]/30 mb-8 flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-[#A4C96A] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($pendaftaran->pasien->user->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500 font-bold uppercase text-xs">Nama Pasien</p>
                                <p class="text-gray-800 font-bold text-lg">{{ $pendaftaran->pasien->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 font-bold uppercase text-xs">Jenis Kelamin / Usia</p>
                                <p class="text-gray-800 font-semibold">
                                    {{ $pendaftaran->pasien->gender == 'L' ? 'Laki-laki' : 'Perempuan' }} 
                                    ({{ \Carbon\Carbon::parse($pendaftaran->pasien->tgl_lahir)->age }} Th)
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-gray-500 font-bold uppercase text-xs">Keluhan Utama</p>
                                <p class="text-gray-800 italic bg-white p-2 rounded border border-gray-200 mt-1">"{{ $pendaftaran->keluhan }}"</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('dokter.update', $pendaftaran->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Diagnosa Penyakit</label>
                            <textarea name="diagnosa" rows="3" 
                                class="w-full rounded-lg border-gray-300 bg-gray-50 focus:border-[#A4C96A] focus:ring-[#A4C96A] focus:bg-white transition duration-200" 
                                required placeholder="Tuliskan diagnosa medis..."></textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Tindakan / Catatan</label>
                            <textarea name="tindakan_dokter" rows="3" 
                                class="w-full rounded-lg border-gray-300 bg-gray-50 focus:border-[#A4C96A] focus:ring-[#A4C96A] focus:bg-white transition duration-200" 
                                required placeholder="Tuliskan tindakan yang dilakukan atau saran dokter..."></textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2 flex items-center justify-between">
                                <span>Resep Obat</span>
                                <span class="text-xs text-gray-500 font-normal">*Bisa pilih lebih dari satu</span>
                            </label>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 bg-gray-50 p-4 rounded-xl border border-gray-200 max-h-60 overflow-y-auto">
                                @foreach($obats as $obat)
                                    <label class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200 hover:border-[#A4C96A] hover:bg-[#FBF8F1] cursor-pointer transition">
                                        <input type="checkbox" name="resep_obat[]" value="{{ $obat->id }}" 
                                            class="rounded text-[#004E64] focus:ring-[#A4C96A] w-5 h-5 border-gray-300">
                                        <div class="text-sm">
                                            <span class="block font-bold text-gray-800">{{ $obat->nama_obat }}</span>
                                            <span class="block text-xs text-green-600">Rp {{ number_format($obat->harga) }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 mt-6">
                            <a href="{{ route('dokter.dashboard') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-[#004E64] text-white rounded-lg font-bold hover:bg-[#00384a] shadow-lg hover:shadow-xl transition duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Pemeriksaan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>