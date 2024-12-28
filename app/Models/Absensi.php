<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'guru_id'
    ];

    public $timestamps = false;
    protected $table = 'absensis';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
