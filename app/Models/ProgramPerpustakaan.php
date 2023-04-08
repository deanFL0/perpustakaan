<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class ProgramPerpustakaan extends Model
{
    use HasFactory, Sortable;

    protected $table = 'program_perpustakaan';
    public $timestamps = false;

    protected $fillable = [
        'jenis_program',
        'jenis_kegiatan',
        'waktu_pelaksanaan',
        'waktu_selesai',
        'keterangan'
    ];

    public $sortable = [
        'jenis_program',
        'jenis_kegiatan',
        'waktu_pelaksanaan',
        'waktu_selesai',
        'keterangan'
    ];
}
