<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Kunjungan as Visit;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Poli;

class VisitController extends Controller
{
    // HALAMAN PENCARIAN + HASIL
    public function index(Request $request)
    {
        // field pencarian seperti di referensi
        $nama     = $request->input('nama');
        $namaKK   = $request->input('nama_kk');
        $noCM     = $request->input('no_cm');
        $nik      = $request->input('nik');
        $kelurahan= $request->input('kelurahan');

        $patients = Pasien::query()
            ->when($nama, function ($q, $v) {
                $q->where('nama_pasien', 'like', "%{$v}%");
            })
            ->when($namaKK, function ($q, $v) {
                $q->where('nama_kk', 'like', "%{$v}%");
            })
            ->when($noCM, function ($q, $v) {
                $q->where('no_rm', 'like', "%{$v}%");
            })
            ->when($nik, function ($q, $v) {
                $q->where('nik', 'like', "%{$v}%");
            })
            ->when($kelurahan, function ($q, $v) {
                $q->where('kelurahan', 'like', "%{$v}%");
            })
            ->orderBy('nama_pasien')
            ->limit(100)
            ->get();

        $polis   = Poli::orderBy('nama_poli')->get();
        $staffs  = Pegawai::orderBy('nama_pegawai')->get();

        return view('visits.index', [
            'patients'   => $patients,
            'polis'      => $polis,
            'staffs'     => $staffs,
            // kirim balik nilai form biar tetap terisi
            'filters'    => compact('nama','namaKK','noCM','nik','kelurahan'),
        ]);
    }

    
    public function create($patientId)
    {
        $patient = Pasien::findOrFail($patientId);
        $polis   = Poli::orderBy('nama_poli')->get();
        $staffs  = Pegawai::orderBy('nama_pegawai')->get();

        return view('visits.create', compact('patient','polis','staffs'));
    }

    // SIMPAN KUNJUNGAN
    public function store(Request $request)
    {
        $data = $request->validate([
            'pasien_id'  => 'required|exists:pasien,id_pasien',
            'poli_id'    => 'nullable|exists:poli,id_poli',
            'staff_id'   => 'nullable|exists:pegawai,id_pegawai',
            'visit_date' => 'required|date',
            'status'     => 'required|in:menunggu,in_consult,selesai,batal',
        ]);

        $datePrefix = Carbon::now()->format('Ymd');
        $no_visit   = 'V'.$datePrefix.Str::upper(Str::random(4));

        try {
            $no_antrian = DB::transaction(function () use ($data,$no_visit) {
                $visitDate = Carbon::parse($data['visit_date'])->toDateString();

                $q = Visit::whereDate('tanggal_kunjungan', $visitDate);

                if (!empty($data['poli_id'])) {
                    $q->where('id_poli', $data['poli_id']);
                }

                $count = $q->lockForUpdate()->count();
                $no_antrian = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

                Visit::create([
                    'no_visit'          => $no_visit,
                    'id_pasien'         => $data['pasien_id'],
                    'id_poli'           => $data['poli_id'] ?? null,
                    'id_pegawai'        => $data['staff_id'] ?? null,
                    'no_antrian'        => $no_antrian,
                    'status'            => $data['status'],
                    'tanggal_kunjungan' => $visitDate,
                ]);

                return $no_antrian;
            });
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan kunjungan: '.$e->getMessage()]);
        }

        return redirect()->route('visits.index')
            ->with('success', 'Kunjungan tercatat. Nomor antrian: '.$no_antrian);
    }

    public function searchJson(Request $request)
    {
        $q = $request->input('q');

        $patients = Pasien::query()
            ->when($q, function ($query,$q) {
                $query->where('nama_pasien','like',"%{$q}%")
                      ->orWhere('no_rm','like',"%{$q}%")
                      ->orWhere('nik','like',"%{$q}%")
                      ->orWhere('alamat','like',"%{$q}%");
            })
            ->limit(100)
            ->get();

        return response()->json(['data' => $patients]);
    }
}
