<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Rekam Medis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    @if($riwayat->isEmpty())
                        <div class="text-center py-10 text-gray-500">
                            <p>Belum ada riwayat pemeriksaan medis.</p>
                            <a href="{{ route('pasien.daftar') }}" class="text-blue-600 hover:underline mt-2 inline-block">Daftar Berobat Sekarang</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($riwayat as $item)
                            <div class="border rounded-lg p-4 hover:shadow-md transition bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tgl_kunjungan)->format('d F Y') }}</p>
                                        <h3 class="font-bold text-lg text-indigo-700">{{ $item->dokter->poli->nama_poli }}</h3>
                                        <p class="text-sm text-gray-700">Dokter: {{ $item->dokter->user->name }}</p>
                                    </div>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold">Selesai</span>
                                </div>
                                
                                <div class="mt-4 border-t pt-2">
                                    <p><strong>Keluhan:</strong> {{ $item->keluhan }}</p>
                                    <p><strong>Diagnosa:</strong> {{ $item->diagnosa }}</p>
                                    <p><strong>Tindakan:</strong> {{ $item->tindakan_dokter }}</p>
                                    
                                    <div class="mt-2">
                                        <strong>Obat Diterima:</strong>
                                        <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                                            @foreach($item->obats as $obat)
                                                <li>{{ $obat->nama_obat }} ({{ $obat->harga }})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>