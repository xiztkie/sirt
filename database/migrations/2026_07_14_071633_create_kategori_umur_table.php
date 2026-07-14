<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_umur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 50)->comment('Contoh: Balita, Remaja, Dewasa');
            $table->integer('batas_minimal')->comment('Batas umur paling bawah (dalam tahun)');
            $table->integer('batas_maksimal')->nullable()->comment('Batas umur paling atas, biarkan kosong (null) jika batasnya ke atas tanpa batas');
            $table->timestamps();
        });

        DB::table('kategori_umur')->insert([
            [
                'nama_kategori' => 'Balita',
                'batas_minimal' => 0,
                'batas_maksimal' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Anak-anak',
                'batas_minimal' => 6,
                'batas_maksimal' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Remaja',
                'batas_minimal' => 12,
                'batas_maksimal' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Dewasa',
                'batas_minimal' => 26,
                'batas_maksimal' => 59,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Lansia',
                'batas_minimal' => 60,
                'batas_maksimal' => null, // null berarti 60 tahun ke atas tanpa batas maksimal
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_umur');
    }
};
