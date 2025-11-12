<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class RekamMedisController extends Controller
{
    // Tampilkan form input rekam medis
    public function create(Visit $visit)
    {
        return view('rekammedis.create', compact('visit'));
    }

    // Simpan rekam medis
    public function store(Request $request, Visit $visit)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
        ]);

        $visit->update([
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
        ]);

        return redirect()->route('visits.index')->with('success', 'Rekam medis berhasil disimpan.');
    }
}
