<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatushubunganModel extends Model
{
    use HasFactory;
    protected $table = 'status_hubungan';
    protected $fillable = [
        'nama',
    ];
}
