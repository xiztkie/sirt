<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatushubunganModel extends Model
{
    use HasFactory;
    protected $table = 'status_hubungan';
    protected $fillable = [
        'nama',
    ];
}
