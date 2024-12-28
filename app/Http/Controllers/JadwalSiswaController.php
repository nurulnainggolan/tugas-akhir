<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalSiswaController extends Controller
{
    public function index()
    {
        // Ambil data jadwal untuk siswa
        $jadwals = Jadwal::where('role', 'siswa')->get();

        return view('siswa.jadwal.index'); // Ganti dengan view yang sesuai
    }
}
