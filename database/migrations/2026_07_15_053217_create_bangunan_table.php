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
        Schema::create('bangunan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_bangunan_id');
            $table->string('nomor');
            $table->string('alamat');
            $table->string('blok')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('pemilik');
            $table->string('kontak')->nullable();
            $table->timestamps();

            $table->foreign('tipe_bangunan_id')->references('id')->on('tipe_bangunans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bangunan');
    }
};
