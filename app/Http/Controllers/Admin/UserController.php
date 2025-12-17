<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Pasien; // Jangan lupa import model Pasien
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('dokter.poli')->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.user.create', compact('polis'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,dokter,perawat,pasien',
            'poli_id' => 'required_if:role,dokter',
            'sip' => 'required_if:role,dokter',
        ]);

        // 2. Buat Akun User Utama (Login)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(), 
        ]);

        // 3. LOGIKA UTAMA: Cek Role dan Buatkan Data Penunjang
        
        if ($request->role === 'dokter') {
            Dokter::create([
                'user_id' => $user->id,
                'poli_id' => $request->poli_id,
                'sip' => $request->sip,
            ]);
        }
        
        // --- INI PERBAIKANNYA AGAR TIDAK ERROR ---
        elseif ($request->role === 'pasien') {
            // Kita buatkan "Wadah Kosong" agar Dashboard tidak error
            Pasien::create([
                'user_id' => $user->id,
                'tgl_lahir' => now(), // Default sementara
                'gender' => 'L',      // Default sementara
                'alamat' => '-',      // Strip artinya "Belum diisi"
                'no_hp' => '-',       // Strip artinya "Belum diisi"
            ]);
        }
        // ------------------------------------------

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    // 2. FUNGSI MENYIMPAN PERUBAHAN (UPDATE)
    public function update(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id, // Abaikan email milik sendiri saat cek unik
            'role'  => 'required|in:admin,dokter,perawat,pasien',
            'password' => 'nullable|min:8', // Password boleh kosong jika tidak ingin diganti
        ]);

        // Data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Cek apakah password diisi? Jika ya, update passwordnya. Jika kosong, biarkan password lama.
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy($id) {
    try {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
        
    } catch (\Illuminate\Database\QueryException $e) {
        // Kode error 23000 biasanya constraint violation
        if ($e->getCode() == "23000") {
            return redirect()->back()->with('error', 'Gagal menghapus! User ini memiliki data riwayat medis/pendaftaran. Hapus data pendaftarannya terlebih dahulu jika ingin menghapus user ini.');
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}
}