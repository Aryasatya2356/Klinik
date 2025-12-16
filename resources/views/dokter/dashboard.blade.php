<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Dashboard Dokter') }}
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
                <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <h3 class="text-xl font-bold text-[#004E64] mb-1">Halo, {{ Auth::user()->name }}</h3>
                    <p class="text-gray-500 text-sm">Selamat bertugas. Ada <strong class="text-[#A4C96A]">{{ $antrian->count() }} pasien</strong> yang menunggu pemeriksaan Anda hari ini.</p>
                </div>

                <div class="bg-[#FBF8F1] p-6 rounded-2xl shadow-sm border-l-4 border-[#004E64] flex items-center justify-between">
                    <div>
                        <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Antrian Saat Ini</div>
                        <div class="text-4xl font-extrabold text-[#004E64]">{{ $antrian->count() }}</div>
                    </div>
                    <div class="bg-[#004E64] text-white p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="bg-[#FBF8F1] px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="bg-[#004E64] p-2 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#004E64]">Daftar Pasien Menunggu</h3>
                </div>

                <div class="p-6">
                    @if($antrian->isEmpty())
                        <div class="text-center py-10">
                            <div class="bg-green-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-[#A4C96A]">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-gray-500 italic">Tidak ada antrian pasien saat ini. Kerja bagus, Dok!</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse rounded-lg overflow-hidden">
                                <thead class="bg-[#004E64] text-white">
                                    <tr>
                                        <th class="p-4 font-bold tracking-wide">No Antrian</th>
                                        <th class="p-4 font-bold tracking-wide">Nama Pasien</th>
                                        <th class="p-4 font-bold tracking-wide">Keluhan Utama</th>
                                        <th class="p-4 font-bold tracking-wide text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($antrian as $item)
                                    <tr class="hover:bg-[#FBF8F1] transition duration-150">
                                        <td class="p-4">
                                            <span class="bg-[#E9F5DB] text-[#004E64] px-3 py-1 rounded-full font-bold text-sm border border-[#A4C96A]">
                                                {{ $item->no_antrian }}
                                            </span>
                                        </td>
                                        <td class="p-4 font-bold text-gray-800">{{ $item->pasien->user->name }}</td>
                                        <td class="p-4 text-sm text-gray-600">{{ Str::limit($item->keluhan, 50) }}</td>
                                        <td class="p-4 text-right">
                                            <a href="{{ route('dokter.periksa', $item->id) }}" class="inline-flex items-center gap-2 bg-[#A4C96A] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-[#8eb555] shadow-md transition duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Periksa
                                            </a>
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