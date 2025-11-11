<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index'); // resources/views/settings/index.blade.php
    }
}
