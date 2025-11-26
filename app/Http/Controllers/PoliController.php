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
        $poli = Poli::orderBy('id_poli', 'asc')->get();
        return view('poli.index', compact('poli'));
    }

    /**
     * Simpan data poli baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_poli'   => 'required|string|max:10|unique:poli,kode_poli',
            'nama_poli'   => 'required|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        Poli::create([
            'kode_poli'   => $request->kode_poli,
            'nama_poli'   => $request->nama_poli,
            'keterangan'  => $request->keterangan,
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
        $poli = Poli::findOrFail($id);

        $request->validate([
            'kode_poli'   => 'required|string|max:10|unique:poli,kode_poli,' . $poli->id_poli . ',id_poli',
            'nama_poli'   => 'required|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);

        $poli->update([
            'kode_poli'   => $request->kode_poli,
            'nama_poli'   => $request->nama_poli,
            'keterangan'  => $request->keterangan,
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
