<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::query();

        // Filter pencarian (optional)
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_pegawai', 'like', "%{$request->search}%")
                  ->orWhere('nip', 'like', "%{$request->search}%")
                  ->orWhere('jabatan', 'like', "%{$request->search}%");
        }

        // ✅ gunakan pagination agar ->links() bisa dipakai
        $pegawai = $query->orderBy('nama_pegawai')->paginate(10);

        return view('pegawai.index', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'nullable|string|max:30',
            'nama_pegawai' => 'required|string|max:100',
            'jabatan' => 'required|string',
            'jenis_kelamin' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'username' => 'required|string|max:50|unique:pegawai,username',
            'password' => 'required|string|min:5',
            'status' => 'nullable|string|in:Aktif,Nonaktif'
        ]);

        // Hash password sebelum disimpan
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nip' => 'nullable|string|max:30',
            'nama_pegawai' => 'required|string|max:100',
            'jabatan' => 'required|string',
            'jenis_kelamin' => 'nullable|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'username' => "required|string|max:50|unique:pegawai,username,{$id},id_pegawai",
            'status' => 'nullable|string|in:Aktif,Nonaktif',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
