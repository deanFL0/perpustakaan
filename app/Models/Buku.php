<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'kelas',
        'pengarang',
        'penerbit',
        'tahunterbit',
        'jenisbuku',
        'jumlah',
        'kondisi'
    ];
}
