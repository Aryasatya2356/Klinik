<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-[#004E64] uppercase font-['Open_Sans']">Kelola Jadwal Dokter</h2>
            <a href="{{ route('jadwal.create') }}" class="bg-[#A4C96A] text-white font-bold py-2 px-4 rounded hover:bg-[#8eb555]">
                + Tambah Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-[#A4C96A] text-green-800 p-4 mb-4 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#004E64] text-white">
                        <tr>
                            <th class="p-4">Hari</th>
                            <th class="p-4">Nama Dokter</th>
                            <th class="p-4">Poli</th>
                            <th class="p-4">Jam Praktik</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($jadwals as $jadwal)
                        <tr class="hover:bg-[#FBF8F1]">
                            <td class="p-4 font-bold">{{ $jadwal->hari }}</td>
                            <td class="p-4">{{ $jadwal->dokter->user->name }}</td>
                            <td class="p-4"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">{{ $jadwal->dokter->poli->nama_poli }}</span></td>
                            <td class="p-4 font-mono text-sm">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Hapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>