<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrambantuanModel extends Model
{
    use HasFactory;
    protected $table = 'program_bantuan';
    protected $fillable = [
        'nama_program',
        'tanggal_mulai',
        'tanggal_selesai',
        'sasaran',
        'sasaran_umur',
        'deskripsi',
    ];
}
