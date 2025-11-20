<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Visit;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Poli;
use Illuminate\Support\Facades\Log;

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
            ->limit(10)
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
        $request->validate([
            'pasien_id'  => 'required|exists:pasien,id_pasien',
            'id_poli'    => 'required',
            'staff_id'   => 'required',
            'visit_date' => 'required|date',
            'status'     => 'required|in:menunggu,in_consult,selesai,batal',
        ]);
        $data = $request->all();
        $datePrefix = Carbon::now()->format('Ymd');
        $no_visit = 'V'.$datePrefix.Str::upper(Str::random(4));
        // Format tanggal
        $visitDate = Carbon::parse($data['visit_date'])->toDateString();

        // Hitung nomor antrian
        $q = Visit::whereDate('tanggal_kunjungan', $visitDate);
        
        if (!empty($data['id_poli'])) {
            $q->where('id_poli', $data['id_poli']);
        }

        $count = $q->count();
        $no_antrian = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        
        $visitData = [
            'no_visit'          => $no_visit,
            'id_pasien'         => $data['pasien_id'],
            'id_poli'           => $data['id_poli'] ?? null,
            'id_pegawai'        => $data['staff_id'] ?? null,
            'no_antrian'        => $no_antrian,
            'status'            => $data['status'],
            'vitals'            => null,
            'diagnosis'         => null,
            'tanggal_kunjungan' => $visitDate,
        ];
        // dd($visitData);
        // Simpan data
        Visit::create($visitData);

        return redirect()->route('visits.index')->with('success', 'Kunjungan berhasil dibuat. Nomor antrian: '.$no_antrian);

//     // Validasi
//     $validated = $request->validate([
//         'pasien_id'  => 'required|exists:pasien,id_pasien',
//         'poli_id'    => 'nullable|exists:poli,id',
//         'staff_id'   => 'nullable|exists:pegawai,id_pegawai',
//         'visit_date' => 'required|date',
//         'status'     => 'required|in:menunggu,in_consult,selesai,batal',
//     ]);

//     // Definisikan variabel di luar try-catch
//     $no_antrian = null;
//     $no_visit = null;

//     try {
//         // Generate nomor visit
//         $datePrefix = Carbon::now()->format('Ymd');
//         $no_visit = 'V'.$datePrefix.Str::upper(Str::random(4));
        
//         // Format tanggal
//         $visitDate = Carbon::parse($validated['visit_date'])->toDateString();
        
//         // Hitung nomor antrian
//         $q = Visit::whereDate('tanggal_kunjungan', $visitDate);
        
//         if (!empty($validated['poli_id'])) {
//             $q->where('poli_id', $validated['poli_id']);
//         }
        
//         $count = $q->count();
//         $no_antrian = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        
//         // Persiapkan data untuk disimpan
//         $visitData = [
//             'no_visit'          => $no_visit,
//             'id_pasien'         => $validated['pasien_id'],
//             'poli_id'           => $validated['poli_id'] ?? null,
//             'id_pegawai'        => $validated['staff_id'] ?? null,
//             'no_antrian'        => $no_antrian,
//             'status'            => $validated['status'],
//             'tanggal_kunjungan' => $visitDate,
//         ];
        
//         // Simpan data
//         $visit = Visit::create($visitData);
        
//         // Debug jika perlu
//         Log::info('Visit created successfully', ['visit_id' => $visit->id]);

//     } catch (\Exception $e) {
//         Log::error('Visit creation failed: '.$e->getMessage(), [
//             'request' => $request->all(),
//             'trace' => $e->getTraceAsString()
//         ]);

//         // Redirect dengan error message
//         return back()
//             ->withInput()
//             ->withErrors(['error' => 'Gagal menyimpan kunjungan: '.$e->getMessage()]);
//     }

//     // Pastikan $no_antrian tidak null sebelum digunakan
//     if ($no_antrian === null) {
//         return back()
//             ->withInput()
//             ->withErrors(['error' => 'Gagal menghasilkan nomor antrian']);
//     }

//     return redirect()->route('visits.index')
//         ->with('success', 'Kunjungan berhasil dibuat. Nomor antrian: '.$no_antrian);

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

    // Antrian
    public function antrian()
    {
        // Ambil kunjungan hari ini dengan status 'in_consult' (sedang berlangsung)
        $currentVisit = Visit::with(['pasien', 'poli'])
            ->whereDate('tanggal_kunjungan', today())
            ->where('status', 'in_consult')
            ->first();

        // Ambil antrian selanjutnya (status 'menunggu')
        $nextVisits = Visit::with(['pasien', 'poli'])
            ->whereDate('tanggal_kunjungan', today())
            ->where('status', 'menunggu')
            ->orderBy('no_visit')
            ->limit(10)
            ->get();

        return view('antrian.index', compact('currentVisit', 'nextVisits'));
    }
}
