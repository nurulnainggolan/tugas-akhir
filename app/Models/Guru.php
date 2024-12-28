<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama', 'mapel_id', 'no_telp', 'alamat', 'foto'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
