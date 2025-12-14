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
                    <tr class="bg-gray-100">
                        <th class="border p-2">Nama Poli</th>
                        <th class="border p-2">Deskripsi</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                    @foreach($polis as $poli)
                    <tr>
                        <td class="border p-2 font-bold">{{ $poli->nama_poli }}</td>
                        <td class="border p-2">{{ $poli->deskripsi }}</td>
                        <td class="border p-2">
                            <a href="{{ route('poli.edit', $poli->id) }}" class="text-yellow-600 hover:underline">Edit</a> | 
                            <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus poli ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>