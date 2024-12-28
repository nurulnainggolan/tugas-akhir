<?php

namespace App\Http\Controllers;

use App\Models\PresensiMeeting;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PresensiMeetingController extends Controller
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
        try {
            $absensiId = $request->input('absensi_id');
            $keterangan = $request->input('keterangan');
            foreach ($keterangan as $id => $value) {
                $siswa = Siswa::find($id);
                // cek apakah siswa sudah absen 
                $presensi = PresensiMeeting::where('siswa_id', $id)->where('meeting_id', $request->input('meeting_id'))->first();
                if ($presensi) {
                    $presensi->update([
                        'status' => $value
                    ]);
                    continue;
                } else {
                    PresensiMeeting::create([
                        'siswa_id' => $siswa->id,
                        'status' => $value,
                        'meeting_id' => $request->input('meeting_id')
                    ]);
                }
            }

            return redirect()->route('absensi.show', $absensiId)->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiMeeting $presensiMeeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(PresensiMeeting $presensiMeeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PresensiMeeting $presensiMeeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PresensiMeeting $presensiMeeting)
    {
        //
    }
}
