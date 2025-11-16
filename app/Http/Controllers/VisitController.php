<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Sesuaikan nama model dengan yang ada di projectmu
use App\Models\Kunjungan as Visit;
use App\Models\Pasien as Pasien;
use App\Models\Pegawai as Pegawai;
use App\Models\Poli as Poli;

class VisitController extends Controller
{
    /**
     * Tampilkan halaman pencarian + daftar pasien (index)
     * View: resources/views/visits/index.blade.php
     */
    public function index(Request $request)
    {
        $q = $request->get('q', null);
        $patients = null;

        if ($q) {
            $patients = Pasien::query()
                ->where('nama_pasien', 'like', "%{$q}%")
                ->orWhere('no_rm', 'like', "%{$q}%")
                ->orWhere('nik', 'like', "%{$q}%")
                ->orWhere('alamat', 'like', "%{$q}%")
                ->limit(200)
                ->get();
        }

        // always kirim list poli & staff supaya modal bisa menggunakan data
        $polis = Poli::orderBy('nama_poli')->get();
        $staffs = Pegawai::orderBy('nama_pegawai')->get();

        return view('visits.index', compact('patients', 'q', 'polis', 'staffs'));
    }

    /**
     * Opsional: endpoint search returning JSON (dipakai jika mau AJAX)
     */
    public function search(Request $request)
    {
        $q = $request->get('q', null);

        $patients = Pasien::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_pasien', 'like', "%{$q}%")
                      ->orWhere('no_rm', 'like', "%{$q}%")
                      ->orWhere('nik', 'like', "%{$q}%")
                      ->orWhere('alamat', 'like', "%{$q}%");
            })
            ->limit(200)
            ->get();

        return response()->json(['data' => $patients]);
    }

    /**
     * Simpan kunjungan — dipanggil dari modal (form POST)
     */
    public function store(Request $request)
    {
        // validasi input (sesuaikan nama tabel/kolom PK di DB-mu)
        $data = $request->validate([
            'pasien_id'  => 'required|exists:pasien,id_pasien',
            'poli_id'    => 'nullable|exists:poli,id_poli',
            'staff_id'   => 'nullable|exists:pegawai,id_pegawai',
            'visit_date' => 'required|date',
            // enum values sesuai pilihan pada view
            'status'     => 'required|in:menunggu,in_consult,selesai,batal',
        ]);

        // buat no_visit unik
        $datePrefix = Carbon::now()->format('Ymd');
        $no_visit = 'V' . $datePrefix . Str::upper(Str::random(4));

        try {
            // transaction: hitung antrian (lock) + simpan
            $no_antrian = DB::transaction(function () use ($data, $no_visit) {

                $visitDate = Carbon::parse($data['visit_date'])->toDateString();

                // hitung antrian hari ini untuk poli tertentu (gunakan created_at agar konsisten)
                $query = Visit::whereDate('created_at', $visitDate);

                if (!empty($data['poli_id'])) {
                    // kolom di tabel kunjungan diasumsikan id_poli
                    $query->where('id_poli', $data['poli_id']);
                }

                // kunci rows untuk menghindari race condition
                $count = $query->lockForUpdate()->count();

                $no_antrian = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

                // buat record kunjungan — perhatikan kolom sesuai migration-mu
                Visit::create([
                    'no_visit'         => $no_visit,
                    'id_pasien'        => $data['pasien_id'],
                    'id_poli'          => $data['poli_id'] ?? null,
                    'id_pegawai'       => $data['staff_id'] ?? null,
                    'no_antrian'       => $no_antrian,
                    'status'           => $data['status'],
                    'tanggal_kunjungan'=> $visitDate,
                ]);

                return $no_antrian;
            });

        } catch (\Throwable $e) {
            // jika ada exception, redirect kembali membuka modal supaya user bisa koreksi
            return redirect()->back()
                ->withInput()
                ->with('open_modal', true)
                ->with('patient_id', $request->input('pasien_id'))
                ->withErrors(['error' => 'Gagal menyimpan kunjungan: '.$e->getMessage()]);
        }

        // sukses — redirect ke index dengan flash success (Notyf akan tampil di view)
        return redirect()->route('visits.index')
            ->with('success', 'Kunjungan tercatat. Nomor antrian: ' . $no_antrian);
    }

    /**
     * (Optional) helper untuk generate nomor antrian (tidak wajib dipakai karena logic di transaction)
     */
    protected function nextQueueNumber($poli_id = null, $date = null)
    {
        $date = $date ? Carbon::parse($date)->toDateString() : now()->toDateString();

        $query = Visit::whereDate('created_at', $date);

        if ($poli_id) {
            $query->where('id_poli', $poli_id);
        }

        $count = $query->count();

        return str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }
}
