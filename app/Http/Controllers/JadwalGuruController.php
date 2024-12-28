<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class JadwalGuruController extends Controller
{
    public function index() {
        $jadwal = JadwalGuru::all();
        return view('jadwal_guru', compact('jadwal'));
    }
}
