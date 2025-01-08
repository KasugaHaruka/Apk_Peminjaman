<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKembali extends Model
{
    use HasFactory;
    protected $table = 'detail_kembali_peminjaman';
    protected $guarded = [];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
    public function kembali()
    {
        return $this->belongsTo(KembaliPeminjaman::class, 'kembali_peminjaman_id');
    }
}
