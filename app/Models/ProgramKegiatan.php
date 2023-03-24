<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKegiatan extends Model
{
    use HasFactory;

    protected $table = 'program_kegiatan';
    public $timestamps = false;

    protected $fillable = [
        'nama_program',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
