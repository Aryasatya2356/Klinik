<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Tambah Pengguna Baru</h2></x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 p-3 rounded text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Email</label>
                            <input type="email" name="email" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Password</label>
                            <input type="password" name="password" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Peran (Role)</label>
                            <select name="role" id="roleSelect" class="w-full border rounded p-2" onchange="toggleDokterForm()">
                                <option value="pasien">Pasien</option>
                                <option value="perawat">Perawat</option>
                                <option value="dokter">Dokter</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div id="dokterForm" class="hidden bg-indigo-50 p-4 rounded border border-indigo-200 mt-4">
                        <h3 class="font-bold text-indigo-700 mb-4">👨‍⚕️ Detail Dokter</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block font-bold mb-2">Spesialis Poli</label>
                                <select name="poli_id" class="w-full border rounded p-2">
                                    <option value="">-- Pilih Poli --</option>
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block font-bold mb-2">Nomor SIP</label>
                                <input type="text" name="sip" class="w-full border rounded p-2" placeholder="Contoh: 123/SIP/2025">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDokterForm() {
            var role = document.getElementById('roleSelect').value;
            var form = document.getElementById('dokterForm');
            
            if (role === 'dokter') {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>