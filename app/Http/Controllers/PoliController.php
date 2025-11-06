<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Tampilkan semua data poli.
     */
    public function index()
    {
        $poli = Poli::orderBy('created_at', 'desc')->get();
        return view('poli.index', compact('poli'));
    }

    /**
     * Tampilkan form tambah poli.
     */
    public function create()
    {
        return view('poli.create');
    }

    /**
     * Simpan data poli baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('poli.index')->with('success', 'Data Poli berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit poli.
     */
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.edit', compact('poli'));
    }

    /**
     * Perbarui data poli.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('poli.index')->with('success', 'Data Poli berhasil diperbarui!');
    }

    /**
     * Hapus data poli.
     */
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Data Poli berhasil dihapus!');
    }
}
