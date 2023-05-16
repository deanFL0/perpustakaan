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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('kelas', 255);
            $table->string('pengarang', 100);
            $table->string('penerbit', 100);
            $table->string('tahunterbit', 255);
            $table->string('jenisbuku', 50);
            $table->string('jumlah', 255);
            $table->string('kondisi', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
