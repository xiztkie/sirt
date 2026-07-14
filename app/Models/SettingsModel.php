<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'nama_daerah',
        'alamat',
        'kode_pos',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'email',
        'no_telp',
        'logo'
    ];
}