<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoiuranModel extends Model
{
    use HasFactory;
    protected $table = 'saldo_iuran';
    protected $fillable = [
        'keluarga_id',
        'warga_id',
        'jumlah_saldo',
    ];
}
