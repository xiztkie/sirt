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
        Schema::create('program_keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keluarga_id');
            $table->unsignedBigInteger('program_id');
            $table->timestamps();
            $table->foreign('keluarga_id')->references('id')->on('keluarga')->onDelete('restrict');
            $table->foreign('program_id')->references('id')->on('program_bantuan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_keluarga');
    }
};
