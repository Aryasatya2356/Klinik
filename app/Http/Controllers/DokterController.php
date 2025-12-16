<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Obat;

class DokterController extends Controller
{
    // 1. Dashboard Dokter (Lihat Antrian)
    public function index()
    {
        // Ambil ID Dokter yang sedang login dari tabel 'dokters'
        $dokter = Auth::user()->dokter;

        // Ambil pasien yang statusnya 'menunggu_dokter' KHUSUS untuk dokter ini
        $antrian = Pendaftaran::with(['pasien.user'])
                ->where('id_dokter', $dokter->id)
                ->where('status', 'menunggu_dokter') // <--- PASTIKAN INI SAMA DENGAN CONTROLLER PERAWAT
                ->whereDate('tgl_kunjungan', now()) 
                ->orderBy('no_antrian', 'asc')
                ->get();;

        return view('dokter.dashboard', compact('antrian'));
    }

    // 2. Form Periksa Pasien
    public function periksa($id)
    {
        $pendaftaran = Pendaftaran::with(['pasien.user', 'pasien'])->findOrFail($id);
        $obats = Obat::all(); // Ambil semua data obat untuk dropdown resep

        return view('dokter.periksa', compact('pendaftaran', 'obats'));
    }

    // 3. Simpan Hasil Periksa & Resep
    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosa' => 'required',
            'tindakan_dokter' => 'required',
            'resep_obat' => 'array', // Array ID obat yang dipilih
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update Diagnosa & Status
        $pendaftaran->update([
            'diagnosa' => $request->diagnosa,
            'tindakan_dokter' => $request->tindakan_dokter,
            'status' => 'menunggu_pembayaran', // Lempar ke Kasir/Perawat
        ]);

        // Simpan Resep Obat (Attach ke Pivot Table)
        if ($request->has('resep_obat')) {
        foreach ($request->resep_obat as $obatId) {
            // 1. Simpan ke riwayat medis (Pivot Table)
            // Kita attach satu per satu agar aman di dalam loop
            $pendaftaran->obats()->attach($obatId);

            // 2. KURANGI STOK OBAT
            // Cari obat berdasarkan ID, lalu kurangi stoknya sebanyak 1
            $obat = Obat::find($obatId);
            if ($obat) {
                $obat->decrement('stok'); 
            }
        }
    }

    return redirect()->route('dokter.dashboard')->with('success', 'Pemeriksaan selesai. Stok obat telah diperbarui. Pasien diarahkan ke pembayaran.');
    }
}