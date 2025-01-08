<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KembaliPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'kembali_peminjaman';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }    
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
    public function detailK()
    {
        return $this->hasMany(DetailKembali::class, 'kembali_peminjaman_id');
    }
}
