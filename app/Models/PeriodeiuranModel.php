<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeiuranModel extends Model
{
    use HasFactory;
    protected $table = 'periode_iuran';
    protected $fillable = [
        'tanggal_mulai',
        'tanggal_akhir',
        'nominal_keluarga',
        'nominal_individu',
        'status',
    ];
}
