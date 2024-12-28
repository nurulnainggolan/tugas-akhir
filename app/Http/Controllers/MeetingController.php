<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Meeting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'pertemuan_ke' => 'required',
            'absensi_id' => 'required'
        ], [
            'pertemuan_ke.required' => 'Pertemuan ke wajib diisi',
            'absensi_id.required' => 'Absensi wajib diisi'
        ]);

        Meeting::create([
            'pertemuan_ke' => $request->pertemuan_ke,
            'absensi_id' => $request->absensi_id
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $meeting = Meeting::find($id);
        $absensi = $meeting->absensi;
        $kelas = $absensi->kelas;
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
        return view('pages.admin.meeting.index', compact('meeting', 'siswa', 'absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        Meeting::find($id)->delete();
        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
