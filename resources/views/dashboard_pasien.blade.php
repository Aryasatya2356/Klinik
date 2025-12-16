<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Dashboard Pasien') }}
        </h2>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-[#A4C96A] text-green-800 p-4 rounded shadow-sm" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(isset($pendaftaranAktif))
                <div class="bg-[#A4C96A] rounded-2xl shadow-xl overflow-hidden text-white relative">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                    
                    <div class="p-8 relative z-10">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div>
                                <h3 class="font-bold text-lg text-green-900 bg-white/20 inline-block px-3 py-1 rounded-full mb-2">
                                    🎫 Tiket Antrian Aktif
                                </h3>
                                <p class="text-green-50 text-sm font-medium opacity-90">Nomor Antrian Anda:</p>
                                <p class="text-6xl font-extrabold tracking-tight mt-1">{{ $pendaftaranAktif->no_antrian }}</p>
                                
                                <div class="mt-4 space-y-1">
                                    <p class="text-lg font-bold flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m8-2a2 2 0 01-2-2h-4a2 2 0 01-2 2v2a2 2 0 012 2h4a2 2 0 012-2v-2z"></path></svg>
                                        {{ $pendaftaranAktif->dokter->poli->nama_poli }}
                                    </p>
                                    <p class="text-sm font-medium opacity-90 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Dokter: {{ $pendaftaranAktif->dokter->user->name }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col items-end">
                                <div class="bg-[#FBF8F1] text-[#004E64] px-6 py-3 rounded-xl font-bold text-lg shadow-sm border border-green-200">
                                    Status: {{ ucfirst(str_replace('_', ' ', $pendaftaranAktif->status)) }}
                                </div>
                                <p class="text-xs text-green-100 mt-3 text-right max-w-xs italic">
                                    *Silakan tunjukkan nomor ini ke Perawat saat tiba di klinik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-[#004E64] mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600">Kesehatan Anda adalah prioritas kami. Silakan pilih layanan di bawah ini.</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-[#FBF8F1] p-8 rounded-2xl shadow-md border border-green-100 hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-[#A4C96A] rounded-full flex items-center justify-center mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-[#004E64] mb-2">Daftar Berobat</h4>
                        <p class="text-gray-600 text-sm mb-6">
                            Ambil nomor antrian untuk pemeriksaan dokter hari ini atau besok secara online.
                        </p>
                    </div>
                    <a href="{{ route('pasien.daftar') }}" class="inline-block text-center bg-[#004E64] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#00384a] transition duration-200 shadow-md">
                        Ambil Antrian
                    </a>
                </div>

                <div class="bg-[#E9F5DB] p-8 rounded-2xl shadow-md border border-green-200 hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-[#009CBD] rounded-full flex items-center justify-center mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-[#004E64] mb-2">Riwayat Medis</h4>
                        <p class="text-gray-600 text-sm mb-6">
                            Lihat catatan hasil pemeriksaan, diagnosa dokter, dan resep obat sebelumnya.
                        </p>
                    </div>
                    <a href="{{ route('pasien.riwayat') }}" class="inline-block text-center bg-[#A4C96A] text-white font-bold py-3 px-6 rounded-lg hover:bg-[#8eb555] transition duration-200 shadow-md">
                        Lihat Riwayat
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>