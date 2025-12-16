<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.poli.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'biaya_jasa' => 'required|numeric|min:0',
        ]);

        Poli::create($request->all());
        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    public function edit(Poli $poli)
    {
        return view('admin.poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'biaya_jasa' => 'required|numeric|min:0', // <--- Tambahkan validasi ini
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($request->all());

        return redirect()->route('poli.index')->with('success', 'Data Poli berhasil diperbarui');
    }

    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus');
    }
}