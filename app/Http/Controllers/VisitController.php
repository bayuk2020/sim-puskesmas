<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::with(['pasien', 'poli']); // relasi ke pasien dan poli

        // fitur pencarian pasien
        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama_pasien', 'like', "%{$search}%");
            });
        }

        $visits = $query->paginate(10);

        return view('visits.index', compact('visits'));
    }
}
