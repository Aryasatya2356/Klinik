<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwals = JadwalDokter::with('dokter')->orderBy('hari', 'desc')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.jadwal.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalDokter::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $dokters = Dokter::with('user')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}