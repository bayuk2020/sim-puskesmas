<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index()
    {
        $tindakan = Tindakan::orderBy('created_at', 'desc')->get();
        return view('tindakan.index', compact('tindakan'));
    }

    public function create()
    {
        return view('tindakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:100',
            'biaya' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Tindakan::create($request->all());
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan!');
    }

    public function edit(Tindakan $tindakan)
    {
        return view('tindakan.edit', compact('tindakan'));
    }

    public function update(Request $request, Tindakan $tindakan)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:100',
            'biaya' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $tindakan->update($request->all());
        return redirect()->route('tindakan.index')->with('success', 'Data tindakan berhasil diperbarui!');
    }

    public function destroy(Tindakan $tindakan)
    {
        $tindakan->delete();
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus!');
    }
}
