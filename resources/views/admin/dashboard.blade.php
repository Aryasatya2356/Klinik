<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
            {{ __('Dashboard Administrator') }}
        </h2>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-[#A4C96A] flex flex-col justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Pasien</p>
                        <h3 class="text-3xl font-extrabold text-[#004E64] mt-1">{{ $totalPasien }}</h3>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-bold">Terdaftar</span>
                    </div>
                </div>

                <div class="bg-[#FBF8F1] p-6 rounded-2xl shadow-sm border-b-4 border-[#004E64] flex flex-col justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Dokter</p>
                        <h3 class="text-3xl font-extrabold text-[#004E64] mt-1">{{ $totalDokter }}</h3>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded font-bold">Aktif</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-[#A4C96A] flex flex-col justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">Poliklinik</p>
                        <h3 class="text-3xl font-extrabold text-[#004E64] mt-1">{{ $totalPoli }}</h3>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded font-bold">Layanan</span>
                    </div>
                </div>

                <div class="bg-[#004E64] p-6 rounded-2xl shadow-sm border border-gray-700 flex flex-col justify-between text-white">
                    <div>
                        <p class="text-sm font-bold text-gray-300 uppercase tracking-wider">Data Obat</p>
                        <h3 class="text-3xl font-extrabold text-white mt-1">{{ $totalObat }}</h3>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <span class="bg-white/20 text-white text-xs px-2 py-1 rounded font-bold">Stok</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="bg-[#FBF8F1] px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-[#004E64]">Pengguna Baru Ditambahkan</h3>
                    <a href="{{ route('user.index') }}" class="text-sm text-[#A4C96A] font-bold hover:underline">Lihat Semua</a>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="p-4 font-bold tracking-wide">Nama</th>
                                <th class="p-4 font-bold tracking-wide">Email</th>
                                <th class="p-4 font-bold tracking-wide">Role</th>
                                <th class="p-4 font-bold tracking-wide">Tanggal Gabung</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($latestUsers as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-bold text-gray-700">{{ $user->name }}</td>
                                <td class="p-4 text-gray-600">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold 
                                        {{ $user->role == 'admin' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $user->role == 'dokter' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $user->role == 'perawat' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $user->role == 'pasien' ? 'bg-green-100 text-green-700' : '' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>