<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabkotaModel extends Model
{
    use HasFactory;
    protected $table = 'kabkota';
    protected $fillable = ['code', 'provinsi_id', 'name_kabkota'];
}
