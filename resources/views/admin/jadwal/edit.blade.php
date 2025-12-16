<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] font-['Open_Sans']">Edit Jadwal Dokter</h2>
    </x-slot>

    <div class="py-12 font-['Open_Sans']">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg border border-gray-100">
                
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Pilih Dokter</label>
                        <select name="id_dokter" class="w-full rounded border-gray-300 focus:border-[#A4C96A] focus:ring-[#A4C96A]">
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" 
                                    {{-- Syntax untuk memilih otomatis dokter yang sedang diedit --}}
                                    {{ $dokter->id == $jadwal->id_dokter ? 'selected' : '' }}>
                                    
                                    {{ $dokter->user->name }} ({{ $dokter->poli->nama_poli }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2 text-gray-700">Hari</label>
                        <select name="hari" class="w-full rounded border-gray-300 focus:border-[#A4C96A] focus:ring-[#A4C96A]">
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" 
                                    {{-- Syntax cek jika hari sama dengan data database --}}
                                    {{ $jadwal->hari == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-4 mb-6">
                        <div class="w-1/2">
                            <label class="block font-bold mb-2 text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" 
                                class="w-full rounded border-gray-300 focus:border-[#A4C96A] focus:ring-[#A4C96A]" 
                                {{-- Mengisi nilai lama --}}
                                value="{{ $jadwal->jam_mulai }}" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block font-bold mb-2 text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" 
                                class="w-full rounded border-gray-300 focus:border-[#A4C96A] focus:ring-[#A4C96A]" 
                                value="{{ $jadwal->jam_selesai }}" required>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-[#004E64] text-white px-6 py-2 rounded font-bold hover:bg-[#00384a] transition">
                            Update Jadwal
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded font-bold hover:bg-gray-300 transition">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>