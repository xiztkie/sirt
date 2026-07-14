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
        Schema::create('program_bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->enum('jenis_program', ['bantuan sosial', 'bantuan kesehatan', 'bantuan pendidikan', 'bantuan ekonomi']);
            $table->enum('sasaran', ['keluarga', 'individu']); 
            $table->enum('sasaran_umur', ['Balita', 'Anak-anak', 'Remaja', 'Dewasa', 'Lansia', 'Semua'])->nullable();
            $table->string('tahun_program');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_bantuan');
    }
};
