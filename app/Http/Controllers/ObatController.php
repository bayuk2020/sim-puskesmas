<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Tampilkan semua data obat.
     */
    public function index()
    {
        $obat = Obat::orderBy('nama_obat', 'asc')->get();
        return view('obat.index', compact('obat'));
    }

    /**
     * Form tambah obat.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Simpan data obat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_obat' => 'required|string|max:20|unique:obat',
            'nama_obat' => 'required|string|max:100',
            'satuan' => 'nullable|string|max:20',
            'stok' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'kadaluwarsa' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil ditambahkan!');
    }

    /**
     * Form edit obat.
     */
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update data obat.
     */
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $request->validate([
            'kode_obat' => 'required|string|max:20|unique:obat,kode_obat,' . $obat->id_obat . ',id_obat',
            'nama_obat' => 'required|string|max:100',
            'satuan' => 'nullable|string|max:20',
            'stok' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'kadaluwarsa' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $obat->update($request->all());

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil diperbarui!');
    }

    /**
     * Hapus data obat.
     */
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil dihapus!');
    }
}
