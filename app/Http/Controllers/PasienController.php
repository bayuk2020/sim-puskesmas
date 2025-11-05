<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Exports\PasienExport;
use Maatwebsite\Excel\Facades\Excel;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_pasien', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%")
                  ->orWhere('no_rm', 'like', "%$search%");
        }

        if ($request->filled('jk')) {
            $query->where('jenis_kelamin', $request->jk);
        }
        if ($request->filled('pekerjaan')) {
            $query->where('pekerjaan', 'like', "%{$request->pekerjaan}%");
        }


        $pasiens = $query->orderBy('id_pasien', 'desc')->paginate(10);
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'nik' => 'required|unique:pasien',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        // Generate No RM otomatis
        $tahun = date('Y');
        $last = Pasien::whereYear('tanggal_daftar', $tahun)->count() + 1;
        $no_rm = $tahun . '-' . str_pad($last, 4, '0', STR_PAD_LEFT);

        Pasien::create([
            'no_rm' => $no_rm,
            'nik' => $request->nik,
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'pekerjaan' => $request->pekerjaan,
            'status_perkawinan' => $request->status_perkawinan,
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pasien::destroy($id);
        return back()->with('success', 'Data pasien berhasil dihapus!');
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.show', compact('pasien'));
    }

    public function riwayat($id)
    {
        $pasien = Pasien::with('kunjungans')->findOrFail($id);
        return view('pasien.riwayat', compact('pasien'));
    }
    public function exportExcel()
    {
        return Excel::download(new PasienExport, 'data-pasien.xlsx');
    }
}
