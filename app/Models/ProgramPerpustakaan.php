<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\User;

class ProgramPerpustakaan extends Model
{
    use HasFactory, Sortable;

    protected $table = 'program_perpustakaan';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'jenis_program',
        'waktu_kegiatan',
        'waktu_selesai',
        'keterangan'
    ];

    public $sortable = [
        'jenis_program',
        'waktu_kegiatan',
        'waktu_selesai',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisKegiatan()
    {
        return $this->hasMany(JenisKegiatan::class);
    }
}
