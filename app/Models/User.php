<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticable
{
    use HasFactory, Notifiable, HasApiTokens ;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'role',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function programPerpustakaan()
    {
        return $this->hasMany(ProgramPerpustakaan::class);
    }
}
