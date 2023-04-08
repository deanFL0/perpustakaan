<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('program_perpustakaan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_program');
            $table->string('jenis_kegiatan');
            $table->date('waktu_pelaksanaan');
            $table->date('waktu_selesai')->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
