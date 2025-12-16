<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Manajemen Poli</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('poli.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Poli</a>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border">
                    <thead class="bg-[#004E64] text-white">
                        <tr>
                            <th class="p-4 font-bold">Nama Poli</th>
                            <th class="p-4 font-bold">Deskripsi</th>
                            <th class="p-4 font-bold">Biaya Jasa</th> <th class="p-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach($polis as $poli)
                        <tr class="hover:bg-[#FBF8F1] transition">
                            <td class="p-4 font-bold text-gray-800">{{ $poli->nama_poli }}</td>
                            <td class="p-4 text-gray-600">{{ Str::limit($poli->deskripsi, 50) }}</td>
                            
                            <td class="p-4 font-bold text-[#004E64]">
                                Rp {{ number_format($poli->biaya_jasa) }}
                            </td>
                            
                            <td class="p-4 text-center">
                                <a href="{{ route('poli.edit', $poli->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>