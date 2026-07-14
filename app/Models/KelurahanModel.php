<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelurahanModel extends Model
{
    use HasFactory;
    protected $table = 'kelurahan';
    protected $fillable = ['code', 'kecamatan_id', 'name_kelurahan'];
}
