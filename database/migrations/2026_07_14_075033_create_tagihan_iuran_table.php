<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tagihan_iuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('keluarga_id')->nullable()->constrained('keluarga')->onDelete('cascade');
            $table->foreignId('warga_id')->nullable()->constrained('warga')->onDelete('cascade');
            $table->foreignId('periode_iuran_id')->constrained('periode_iuran');
            $table->tinyInteger('bulan')->comment('1-12');
            $table->year('tahun');
            $table->unsignedInteger('nominal_tagihan');
            $table->enum('status', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->date('tanggal_bayar')->nullable();
            $table->string('metode_bayar')->nullable()->comment('Cash, Transfer, Potong Saldo');
            $table->string('keterangan')->nullable();

            $table->timestamps();
            $table->unique(['keluarga_id', 'bulan', 'tahun'], 'unik_tagihan_kel');
            $table->unique(['warga_id', 'bulan', 'tahun'], 'unik_tagihan_wrg');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tagihan_iuran');
    }
};
