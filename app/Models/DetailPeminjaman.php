<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_peminjaman';
    protected $guarded = [];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }
}
