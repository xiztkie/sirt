<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriumurModel extends Model
{
    use HasFactory;
    protected $table = 'kategori_umur';
    protected $fillable = [
        'kategori_umur',
        'batas_minimal',
        'batas_maksimal',
    ];
}
