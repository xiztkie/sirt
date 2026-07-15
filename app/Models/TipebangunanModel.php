<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipebangunanModel extends Model
{
    use HasFactory;
    protected $table = 'tipe_bangunans';
    protected $fillable = ['nama'];
}
