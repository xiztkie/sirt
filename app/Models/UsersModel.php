<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'email',
        'email_verified_at',
        'password',
        'address',
        'contact',
        'role',
        'avatar',
        'is_active',
    ];
}
