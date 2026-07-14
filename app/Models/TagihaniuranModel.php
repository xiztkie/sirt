<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihaniuranModel extends Model
{
    use HasFactory;
    protected $table = 'tagihan_iuran';
    protected $fillable = [
        'keluarga_id',
        'warga_id',
        'periode_iuran_id',
        'bulan',
        'tahun',
        'nominal_tagihan',
        'status',
        'tanggal_bayar',
        'metode_bayar',
        'keterangan',
    ];
}
