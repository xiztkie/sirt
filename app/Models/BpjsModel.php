<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BpjsModel extends Model
{
    use HasFactory;
    protected $table = 'bpjs';
    protected $fillable = [
        'warga_id',
        'nomor_bpjs',
        'jenis_bpjs',
    ];
}
