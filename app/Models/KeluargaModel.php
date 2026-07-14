<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaModel extends Model
{
    use HasFactory;
    protected $table = 'keluarga';
    protected $fillable = [
        'nomor_kk',
        'nama_kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'file_kk',
    ];
}
