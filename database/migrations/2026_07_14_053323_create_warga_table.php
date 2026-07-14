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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->enum('agama', ['islam', 'kristen', 'konghucu', 'katolik', 'hindu', 'buddha', 'lainnya']);
            $table->enum('status_perkawinan', ['belum_kawin', 'kawin', 'cerai mati', 'cerai hidup']);
            $table->string('pekerjaan');
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('tipe_warga', ['penduduk', 'non_penduduk']);
            $table->enum('status_keluarga', ['keluarga', 'individu']);
            $table->unsignedBigInteger('keluarga_id')->nullable();
            $table->boolean('kepala_keluarga')->default(false);
            $table->string('status_hubungan')->nullable();
            $table->string('file_ktp')->nullable();
            $table->enum('status_kesejahteraan', ['mampu', 'tidak_mampu'])->default('mampu');
            $table->enum('status', ['hidup', 'meninggal', 'pindah'])->default('hidup');
            $table->date('tanggal_meninggal')->nullable();
            $table->date('tanggal_pindah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
