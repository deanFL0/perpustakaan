<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\ProgramPerpustakaan;

class JenisKegiatan extends Model
{
    use HasFactory, Sortable;
    protected $table = 'jenis_kegiatan';
    public $timestamps = false;

    protected $fillable = [
        'program_perpustakaan_id',
        'nama_kegiatan'
    ];

    public $sortable = [
        'nama_kegiatan'
    ];

    public function program()
    {
        return $this->belongsTo(ProgramPerpustakaan::class);
    }
}
