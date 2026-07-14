<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('saldo_iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->nullable()->unique()->constrained('keluarga')->onDelete('cascade');
            $table->foreignId('warga_id')->nullable()->unique()->constrained('warga')->onDelete('cascade');
            $table->unsignedBigInteger('jumlah_saldo')->default(0)->comment('Total uang titipan saat ini');
            $table->timestamp('terakhir_diupdate')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saldo_iuran');
    }
};
