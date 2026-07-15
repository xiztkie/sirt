<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotobangunanModel extends Model
{
    use HasFactory;
    protected $table = 'foto_bangunan';
    protected $fillable = ['bangunan_id', 'foto'];
}
