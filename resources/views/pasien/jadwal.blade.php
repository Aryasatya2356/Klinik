<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] uppercase font-['Open_Sans']">Jadwal Praktik Dokter</h2>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($urutanHari as $hari)
                    @if(isset($jadwals[$hari]))
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-green-100 flex flex-col h-full">
                            <div class="bg-[#004E64] text-white py-3 px-5 font-bold text-center tracking-wider uppercase">
                                {{ $hari }}
                            </div>
                            
                            <div class="p-5 flex-1 bg-[#FBF8F1]">
                                <ul class="space-y-4">
                                    @foreach($jadwals[$hari] as $jadwal)
                                        <li class="flex items-start gap-3 border-b border-green-200/50 pb-3 last:border-0 last:pb-0">
                                            <div class="w-10 h-10 bg-[#A4C96A] rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">
                                                {{ substr($jadwal->dokter->user->name, 0, 1) }}
                                            </div>
                                            
                                            <div>
                                                <p class="font-bold text-[#004E64]">{{ $jadwal->dokter->user->name }}</p>
                                                <p class="text-xs text-gray-500 font-semibold">{{ $jadwal->dokter->poli->nama_poli }}</p>
                                                <div class="mt-1 inline-block bg-white px-2 py-0.5 rounded text-xs font-mono text-green-700 border border-green-200">
                                                    ⏰ {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if($jadwals->isEmpty())
                <div class="text-center py-10 text-gray-500 italic">Belum ada jadwal dokter yang tersedia.</div>
            @endif
        </div>
    </div>
</x-app-layout>