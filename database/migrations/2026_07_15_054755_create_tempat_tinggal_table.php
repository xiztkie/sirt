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
        Schema::create('tempat_tinggal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->foreignId('bangunan_id')->constrained('bangunan')->onDelete('cascade');
            $table->enum('status_tempat_tinggal', ['milik_sendiri', 'sewa', 'kontrak', 'kos' ,'lainnya']);
            $table->enum('status',['tinggal', 'pindah', 'meninggal'])->default('tinggal');
            $table->date('tanggal_mulai_tinggal')->nullable();
            $table->date('tanggal_berakhir_tinggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_tinggal');
    }
};
