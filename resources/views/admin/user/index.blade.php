<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-[#004E64] leading-tight uppercase tracking-wide font-['Open_Sans']">
                {{ __('Kelola Pengguna') }}
            </h2>
            <a href="{{ route('user.create') }}" class="bg-[#A4C96A] text-white text-sm font-bold py-2 px-4 rounded-lg shadow hover:bg-[#8eb555] transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah User
            </a>
        </div>
    </x-slot>

    <div class="py-8 font-['Open_Sans']">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-[#A4C96A] text-green-800 p-4 rounded shadow-sm mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-6">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">

            <div class="bg-white overflow-hidden shadow-md sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#004E64] text-white">
                            <tr>
                                <th class="p-4 font-bold tracking-wide">Nama Lengkap</th>
                                <th class="p-4 font-bold tracking-wide">Email</th>
                                <th class="p-4 font-bold tracking-wide">Role / Peran</th>
                                <th class="p-4 font-bold tracking-wide text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-[#FBF8F1] transition duration-150">
                                <td class="p-4 font-bold text-gray-800">{{ $user->name }}</td>
                                <td class="p-4 text-gray-600">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border 
                                        {{ $user->role == 'admin' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                        {{ $user->role == 'dokter' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                        {{ $user->role == 'perawat' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                        {{ $user->role == 'pasien' ? 'bg-green-50 text-green-700 border-green-200' : '' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center flex justify-center gap-2">
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-[#004E64] hover:bg-gray-100 p-2 rounded transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                {{-- $users->links() --}} 
            </div>

        </div>
    </div>
</x-app-layout>