<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    // 1. Dashboard Dokter (Lihat Antrian)
    public function index()
    {
        // Ambil ID Dokter yang sedang login dari tabel 'dokters'
        $dokter = Auth::user()->dokter;

        // Ambil pasien yang statusnya 'menunggu_dokter' KHUSUS untuk dokter ini
        $antrian = Pendaftaran::where('id_dokter', $dokter->id)
            ->where('status', 'menunggu_dokter')
            ->with('pasien.user')
            ->get();

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
            $pendaftaran->obats()->sync($request->resep_obat);
        }

        return redirect()->route('dokter.dashboard')->with('success', 'Pemeriksaan selesai. Pasien diarahkan ke pembayaran.');
    }
}