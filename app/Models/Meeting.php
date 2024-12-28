<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'absensi_id',
        'pertemuan_ke'
    ];


    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function presensi()
    {
        return $this->hasMany(PresensiMeeting::class, 'meeting_id');
    }
}
