<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'siswa_id',
        'status',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
