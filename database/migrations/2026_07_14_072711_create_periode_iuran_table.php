<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('periode_iuran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir')->nullable()->comment('Kosongkan jika masih berlaku sampai saat ini');
            $table->unsignedBigInteger('nominal_keluarga')->comment('Tarif untuk warga KK setempat');
            $table->unsignedBigInteger('nominal_individu')->comment('Tarif untuk warga anak kos/individu');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periode_iuran');
    }
};
