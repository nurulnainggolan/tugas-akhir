<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nilai_id',
        'siswa_id',
        'harian',
        'uts',
        'uas'
    ];
}
