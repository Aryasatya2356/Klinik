<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Berobat Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pasien.simpan') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Pilih Dokter & Poli</label>
                            <select name="id_dokter" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">
                                        {{ $dokter->poli->nama_poli }} - {{ $dokter->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="tgl_kunjungan" class="block font-bold text-sm text-gray-800 mb-2">Rencana Tanggal Kunjungan</label>
    
                            <input type="date" 
                                id="tgl_kunjungan" 
                                name="tgl_kunjungan" 
                                min="{{ date('Y-m-d') }}" 
                                max="{{ date('Y-m-d', strtotime('+3 days')) }}" class="w-full rounded-md border border-gray-300 bg-gray-50 text-gray-900 shadow-sm p-3 focus:border-[#A4C96A] focus:ring-2 focus:ring-[#A4C96A] focus:bg-white transition duration-200" required>
                            <p class="text-xs text-gray-500 mt-1 italic">*Pendaftaran hanya dibuka untuk H-0 sampai H-3.</p>
                            <x-input-error :messages="$errors->get('tgl_kunjungan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Keluhan Utama</label>
                            <textarea name="keluhan" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" placeholder="Contoh: Demam sudah 3 hari, pusing kepala..."></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>