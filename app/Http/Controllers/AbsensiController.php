<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $guru = Guru::all();
        $kelas = Kelas::all();

        if (auth()->user()->roles == 'guru') {
            $authGuru = Guru::where('user_id', auth()->user()->id)->first();
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->where('guru_id', $authGuru->id)->get();
        } elseif (auth()->user()->roles == 'siswa') {
            $siswa = Siswa::where('user_id', auth()->user()->id)->first();
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->where('kelas_id', $siswa->id)->get();
        } else {
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->get();
        }

        // return $absensi;
        return view('pages.admin.absensi.index', compact('absensi', 'guru', 'kelas'));
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
            'kelas_id' => 'required'
        ], [
            'guru_id.required' => 'Guru wajib diisi',
            'kelas_id.required' => 'Kelas wajib diisi'
        ]);

        Absensi::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $absensi = Absensi::find($id);
        $siswa = Siswa::with('presensi')->where('kelas_id', $absensi->kelas_id)->get();
        $meetings = $absensi->meetings;
        // return $siswa->first()->presensi->where('meeting_id', 2)->first()->status;
        return view('pages.admin.absensi.detail', compact('absensi', 'siswa', 'meetings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        return view('pages.admin.absensi.edit', compact('absensi', 'guru', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $this->validate($request, [
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ], [
            'guru_id.required' => 'Guru wajib diisi',
            'kelas_id.required' => 'Kelas wajib diisi'
        ]);

        $absensi->update([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Absensi::find($id)->delete();
        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
