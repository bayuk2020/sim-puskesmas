<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Visit;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Poli;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $patients = Pasien::query()
            ->when($request->nama, fn($q)=>$q->where('nama_pasien','like',"%{$request->nama}%"))
            ->when($request->nama_kk, fn($q)=>$q->where('nama_kk','like',"%{$request->nama_kk}%"))
            ->when($request->no_cm, fn($q)=>$q->where('no_rm','like',"%{$request->no_cm}%"))
            ->when($request->nik, fn($q)=>$q->where('nik','like',"%{$request->nik}%"))
            ->when($request->kelurahan, fn($q)=>$q->where('kelurahan','like',"%{$request->kelurahan}%"))
            ->orderBy('nama_pasien')->limit(10)->get();

        return view('visits.index', [
            'patients' => $patients,
            'polis' => Poli::orderBy('nama_poli')->get(),
            'staffs' => Pegawai::orderBy('nama_pegawai')->get(),
        ]);
    }

    public function create($patientId)
    {
        return view('visits.create', [
            'patient' => Pasien::findOrFail($patientId),
            'polis' => Poli::orderBy('nama_poli')->get(),
            'staffs' => Pegawai::orderBy('nama_pegawai')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id_pasien',
            'id_poli' => 'required',
            'staff_id' => 'required',
            'visit_date' => 'required|date',
        ]);

        $poli = Poli::findOrFail($request->id_poli);
        $visitDate = Carbon::parse($request->visit_date)->toDateString();

        $last = Visit::where('id_poli', $poli->id_poli)
            ->whereDate('tanggal_kunjungan', $visitDate)
            ->orderBy('no_antrian', 'desc')
            ->first();

        $nextNumber = $last
            ? intval(substr($last->no_antrian, strlen($poli->kode_poli))) + 1
            : 1;

        $no_antrian = $poli->kode_poli . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        Visit::create([
            'no_visit' => 'V' . Carbon::now()->format('Ymd') . Str::upper(Str::random(4)),
            'id_pasien' => $request->pasien_id,
            'id_poli' => $poli->id_poli,
            'id_pegawai' => $request->staff_id,
            'no_antrian' => $no_antrian,
            'status' => 'menunggu',
            'tanggal_kunjungan' => $visitDate,
        ]);

        return redirect()->route('visits.index')->with('success', 'Kunjungan berhasil ditambahkan');
    }

    public function nextAntrian($id_poli)
    {
        $poli = Poli::findOrFail($id_poli);
        $today = Carbon::today()->toDateString();

        $last = Visit::where('id_poli', $poli->id_poli)
            ->whereDate('tanggal_kunjungan', $today)
            ->orderBy('no_antrian', 'desc')
            ->first();

        $next = $last
            ? intval(substr($last->no_antrian, strlen($poli->kode_poli))) + 1
            : 1;

        return response()->json([
            'next_antrian' => $poli->kode_poli . str_pad($next, 3, '0', STR_PAD_LEFT)
        ]);
    }

   public function antrian()
{
    $polis = Poli::orderBy('nama_poli')->get();

    $today = Carbon::today()->toDateString();
    $result = [];

    foreach ($polis as $poli) {

        // sedang dipanggil (status in_consult)
        $current = Visit::with('pasien')
            ->where('id_poli', $poli->id_poli)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status', 'in_consult')
            ->orderBy('no_antrian')
            ->first();

        // berikutnya (status menunggu)
        $next = Visit::with('pasien')
            ->where('id_poli', $poli->id_poli)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status', 'menunggu')
            ->orderBy('no_antrian')
            ->first();

        // sisa antrian
        $sisa = Visit::where('id_poli', $poli->id_poli)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status', 'menunggu')
            ->count();

        $result[] = [
            'poli' => $poli,
            'current' => $current,
            'next' => $next,
            'sisa' => $sisa
        ];
    }

    return view('visits.antrian_monitor', compact('result'));
}

}
