<x-app-layout>
    <x-slot name="header"><h2 class="font-bold text-xl text-[#004E64]">Tambah Jadwal</h2></x-slot>
    <div class="py-12 font-['Open_Sans']">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Pilih Dokter</label>
                        <select name="id_dokter" class="w-full rounded border-gray-300">
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->user->name }} ({{ $dokter->poli->nama_poli }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Hari</label>
                        <select name="hari" class="w-full rounded border-gray-300">
                            <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option><option>Sabtu</option><option>Minggu</option>
                        </select>
                    </div>
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="block font-bold mb-2">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full rounded border-gray-300" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block font-bold mb-2">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="w-full rounded border-gray-300" required>
                        </div>
                    </div>
                    <button type="submit" class="bg-[#004E64] text-white px-4 py-2 rounded font-bold hover:bg-[#00384a]">Simpan Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>