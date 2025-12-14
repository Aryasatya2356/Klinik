<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Pengguna</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('user.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah User Baru</a>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border text-sm">
                    <tr class="bg-gray-100">
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Role</th>
                        <th class="border p-2">Detail (Khusus Dokter)</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            <span class="px-2 py-1 rounded text-xs font-bold 
                                {{ $user->role == 'admin' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $user->role == 'dokter' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                {{ $user->role == 'perawat' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $user->role == 'pasien' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="border p-2">
                            @if($user->role == 'dokter' && $user->dokter)
                                {{ $user->dokter->poli->nama_poli }} (SIP: {{ $user->dokter->sip }})
                            @else
                                -
                            @endif
                        </td>
                        <td class="border p-2 text-center">
                            @if($user->id != Auth::id()) <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                </form>
                            @else
                                <span class="text-gray-400 italic">Akun Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>