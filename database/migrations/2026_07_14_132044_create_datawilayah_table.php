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
        Schema::create('provinsi', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name_provinsi');
            $table->timestamps();
            $table->index('name_provinsi');
        });

        Schema::create('kabkota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provinsi_id');
            $table->string('code')->unique();
            $table->string('name_kabkota');
            $table->timestamps();
            $table->foreign('provinsi_id')
                ->references('id')
                ->on('provinsi')
                ->cascadeOnDelete();

            $table->index('provinsi_id');
            $table->index('name_kabkota');
        });

        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabkota_id');
            $table->string('code')->unique();
            $table->string('name_kecamatan');
            $table->timestamps();
            $table->foreign('kabkota_id')
                ->references('id')
                ->on('kabkota')
                ->cascadeOnDelete();

            $table->index('kabkota_id');
            $table->index('name_kecamatan');
        });

        Schema::create('kelurahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('code')->unique();
            $table->string('name_kelurahan');
            $table->timestamps();
            $table->foreign('kecamatan_id')
                ->references('id')
                ->on('kecamatan')
                ->cascadeOnDelete();

            $table->index('kecamatan_id');
            $table->index('name_kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahan');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kabkota');
        Schema::dropIfExists('provinsi');
    }
};
