<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramwargaModel extends Model
{
    use HasFactory;
    protected $table = 'program_warga';
    protected $fillable = [
        'warga_id',
        'program_id',
    ];
}
