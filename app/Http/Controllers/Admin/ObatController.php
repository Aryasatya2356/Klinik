<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // Tampilkan semua obat
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    // Form Tambah Obat
    public function create()
    {
        return view('admin.obat.create');
    }

    // Simpan Obat Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    // Form Edit Obat
    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    // Update Obat
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui');
    }

    // Hapus Obat
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus');
    }
}