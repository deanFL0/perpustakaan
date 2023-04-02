<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ProgramKegiatan extends Model
{
    use HasFactory, Sortable;

    protected $table = 'program_kegiatan';
    public $timestamps = false;

    protected $fillable = [
        'nama_program',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public $sortable = [
        'nama_program',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
}
