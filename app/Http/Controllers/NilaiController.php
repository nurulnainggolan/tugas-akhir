<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authGuru = Guru::where('user_id', auth()->user()->id)->first();
        $authSiswa = Siswa::where('user_id', auth()->user()->id)->first();
        $guru = Guru::with('mapel')->get();
        $nilai = Nilai::with('guru')->get();
        $kelas = Kelas::with('guru')->get();

        if ($authGuru) {
            $nilai = Nilai::where('guru_id', $authGuru->id)->get();
        } else {
            $nilai = Nilai::where('kelas_id', $authSiswa->kelas_id)->get();
        }

        return view('pages.admin.Nilai.index', compact('guru', 'nilai', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'guru_id' => 'required',
            'kelas_id' => 'required',
        ], [
            'guru_id.required' => 'Guru harus dipilih',
            'kelas_id.required' => 'Kelas harus dipilih',
        ]);

        Nilai::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $nilai = Nilai::find($id);
        $guru = $nilai->guru;
        $kelas = $nilai->kelas;
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
        return view('pages.admin.Nilai.detail', compact('guru', 'nilai', 'kelas', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Nilai::find($id)->delete();
        return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus');
    }
}
