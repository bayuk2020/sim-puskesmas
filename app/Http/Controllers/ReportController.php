<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily()
    {
        return view('reports.daily'); // resources/views/reports/daily.blade.php
    }

    public function monthly()
    {
        return view('reports.monthly');
    }

    public function doctor()
    {
        return view('reports.doctor');
    }

    public function poli()
    {
        return view('reports.poli');
    }
}
