<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BangunanModel extends Model
{
    use HasFactory;
    protected $table = 'bangunan';
    protected $fillable = [
        'tipe_bangunan_id',
        'nomor',
        'alamat',
        'blok',
        'longitude',
        'latitude',
        'pemilik',
        'kontak'
    ];
}
