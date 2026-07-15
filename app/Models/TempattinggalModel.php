<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempattinggalModel extends Model
{
    use HasFactory;
    protected $table = 'tempat_tinggal';
    protected $fillable = [
        'warga_id',
        'bangunan_id',
        'status_tempat_tinggal',
        'status',
        'tanggal_mulai_tinggal',
        'tanggal_berakhir_tinggal',
        'keterangan',
    ];
}
