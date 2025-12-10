<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman Perawat (Front Office)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded shadow border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm">Pasien Terdaftar Baru</div>
                    <div class="text-2xl font-bold">8</div>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm">Menunggu Dokter</div>
                    <div class="text-2xl font-bold">3</div>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm">Selesai / Pulang</div>
                    <div class="text-2xl font-bold">5</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-4 text-blue-800">📋 Antrian Pendaftaran (Butuh Validasi)</h3>
                        
                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                        @endif

                        @if($antrianBaru->isEmpty())
                            <p class="text-gray-500 italic">Belum ada pasien baru yang mendaftar hari ini.</p>
                        @else
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="p-3">No Antrian</th>
                                        <th class="p-3">Nama Pasien</th>
                                        <th class="p-3">Poli Tujuan</th>
                                        <th class="p-3">Keluhan</th>
                                        <th class="p-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($antrianBaru as $item)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3 font-bold">{{ $item->no_antrian }}</td>
                                        <td class="p-3">{{ $item->pasien->user->name }}</td>
                                        <td class="p-3">{{ $item->dokter->poli->nama_poli }}</td>
                                        <td class="p-3 text-sm text-gray-600">{{ Str::limit($item->keluhan, 30) }}</td>
                                        <td class="p-3">
                                            <form action="{{ route('perawat.validasi', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 shadow">
                                                    ✅ Verifikasi Hadir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4 text-green-800">💰 Antrian Pembayaran (Kasir)</h3>
                    
                    @if($antrianPembayaran->isEmpty())
                        <p class="text-gray-500 italic">Belum ada tagihan pembayaran.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="p-3">Nama Pasien</th>
                                    <th class="p-3">Rincian Biaya</th>
                                    <th class="p-3">Total Tagihan</th>
                                    <th class="p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($antrianPembayaran as $item)
                                    @php
                                        // Hitung Total Obat
                                        $totalObat = $item->obats->sum('harga');
                                        // Biaya Jasa Dokter (Misal Flat Rp 50.000)
                                        $jasaDokter = 50000; 
                                        $grandTotal = $totalObat + $jasaDokter;
                                    @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 font-bold">{{ $item->pasien->user->name }}</td>
                                    <td class="p-3 text-sm">
                                        <span class="block">Jasa Dokter: Rp {{ number_format($jasaDokter) }}</span>
                                        <span class="block">Obat ({{ $item->obats->count() }} item): Rp {{ number_format($totalObat) }}</span>
                                    </td>
                                    <td class="p-3 font-bold text-green-600 text-lg">
                                        Rp {{ number_format($grandTotal) }}
                                    </td>
                                    <td class="p-3">
                                        <form action="{{ route('perawat.bayar', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 shadow" onclick="return confirm('Konfirmasi pembayaran lunas?')">
                                                💵 Proses Bayar
                                            </button>
                                        </form>
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