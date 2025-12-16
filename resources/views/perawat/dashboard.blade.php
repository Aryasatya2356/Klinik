<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Dashboard Perawat') }}
        </h2>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-[#A4C96A] text-green-800 p-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#A4C96A] flex flex-col">
                    <div class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Pasien Terdaftar</div>
                    <div class="text-4xl font-extrabold text-[#004E64]">{{ $antrianBaru->count() }}</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#009CBD] flex flex-col">
                    <div class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Menunggu Dokter</div>
                    <div class="text-4xl font-extrabold text-[#004E64]">{{ $antrianMenunggu->count() }}</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-[#004E64] flex flex-col">
                    <div class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Antrian Kasir</div>
                    <div class="text-4xl font-extrabold text-[#004E64]">{{ $antrianPembayaran->count() }}</div>
                </div>
            </div>

            <div id="validasi" class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="bg-[#FBF8F1] px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="bg-[#A4C96A] p-2 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#004E64]">Antrian Pendaftaran (Butuh Validasi)</h3>
                </div>
                
                <div class="p-6">
                    @if($antrianBaru->isEmpty())
                        <p class="text-gray-500 italic text-center py-4">Belum ada pasien baru yang mendaftar hari ini.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse rounded-lg overflow-hidden">
                                <thead class="bg-[#A4C96A] text-white">
                                    <tr>
                                        <th class="p-4 font-bold tracking-wide">No Antrian</th>
                                        <th class="p-4 font-bold tracking-wide">Nama Pasien</th>
                                        <th class="p-4 font-bold tracking-wide">Poli Tujuan</th>
                                        <th class="p-4 font-bold tracking-wide">Keluhan</th>
                                        <th class="p-4 font-bold tracking-wide">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($antrianBaru as $item)
                                    <tr class="hover:bg-[#FBF8F1] transition duration-150">
                                        <td class="p-4 font-extrabold text-[#004E64]">{{ $item->no_antrian }}</td>
                                        <td class="p-4 font-medium">{{ $item->pasien->user->name }}</td>
                                        <td class="p-4">{{ $item->dokter->poli->nama_poli }}</td>
                                        <td class="p-4 text-sm text-gray-600">{{ Str::limit($item->keluhan, 30) }}</td>
                                        <td class="p-4">
                                            <form action="{{ route('perawat.validasi', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-[#004E64] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#00384a] shadow transition duration-200 flex items-center gap-2">
                                                    <span>Hadir</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div id="kasir" class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="bg-[#FBF8F1] px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="bg-[#004E64] p-2 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#004E64]">Antrian Pembayaran (Kasir)</h3>
                </div>

                <div class="p-6">
                    @if($antrianPembayaran->isEmpty())
                        <p class="text-gray-500 italic text-center py-4">Belum ada tagihan pembayaran.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse rounded-lg overflow-hidden">
                                <thead class="bg-[#004E64] text-white">
                                    <tr>
                                        <th class="p-4 font-bold tracking-wide">Nama Pasien</th>
                                        <th class="p-4 font-bold tracking-wide">Rincian Biaya</th>
                                        <th class="p-4 font-bold tracking-wide">Total Tagihan</th>
                                        <th class="p-4 font-bold tracking-wide">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($antrianPembayaran as $item)
                                        @php
                                            $totalObat = $item->obats->sum('harga');
                                            // --- LOGIKA BARU: DINAMIS ---
                                            // Mengambil harga dari relasi: Pendaftaran -> Dokter -> Poli -> biaya_jasa
                                            // Jika kosong (null), pakai default 50000
                                            $jasaDokter = $item->dokter->poli->biaya_jasa ?? 50000; 
                                            
                                            $grandTotal = $totalObat + $jasaDokter;
                                        @endphp
                                    <tr class="hover:bg-[#FBF8F1] transition duration-150">
                                        <td class="p-4 font-bold text-gray-800">{{ $item->pasien->user->name }}</td>
                                        <td class="p-4 text-sm text-gray-600">
                                            <div class="flex flex-col gap-1">
                                                <span class="font-semibold text-[#004E64]">
                                                    Jasa {{ $item->dokter->poli->nama_poli }}: Rp {{ number_format($jasaDokter) }}
                                                </span>
                                                <span>Obat ({{ $item->obats->count() }} item): Rp {{ number_format($totalObat) }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 font-extrabold text-[#004E64] text-lg">
                                            Rp {{ number_format($grandTotal) }}
                                        </td>
                                        <td class="p-4">
                                            <form action="{{ route('perawat.bayar', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="bg-[#A4C96A] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#8eb555] shadow transition duration-200 flex items-center gap-2" onclick="return confirm('Konfirmasi pembayaran lunas?')">
                                                    <span>Proses Bayar</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>