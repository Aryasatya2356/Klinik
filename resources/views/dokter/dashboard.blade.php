<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    Halo, <strong>{{ Auth::user()->name }}</strong>.<br>
                    Siap melayani pasien hari ini?
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-indigo-500 text-white p-4 rounded shadow">
                    <div class="text-2xl font-bold">5</div>
                    <div class="text-sm">Pasien Menunggu</div>
                </div>
                <div class="bg-green-500 text-white p-4 rounded shadow">
                    <div class="text-2xl font-bold">12</div>
                    <div class="text-sm">Pasien Selesai</div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4 text-indigo-800">🩺 Daftar Pasien Menunggu ({{ $antrian->count() }})</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                    @endif

                    @if($antrian->isEmpty())
                        <p class="text-gray-500 italic">Tidak ada antrian pasien saat ini.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-3">No Antrian</th>
                                    <th class="p-3">Nama Pasien</th>
                                    <th class="p-3">Keluhan</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($antrian as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 font-bold">{{ $item->no_antrian }}</td>
                                    <td class="p-3">{{ $item->pasien->user->name }}</td>
                                    <td class="p-3 text-sm">{{ Str::limit($item->keluhan, 40) }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('dokter.periksa', $item->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                                            Periksa Pasien
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>