<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;
    protected $table = 'alat';
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(JenisAlat::class, 'jenis_id');
    }
}
