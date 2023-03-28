<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
