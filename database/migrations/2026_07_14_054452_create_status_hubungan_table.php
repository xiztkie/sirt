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
        Schema::create('status_hubungan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
        DB::table('status_hubungan')->insert([
            ['nama' => 'Kepala Keluarga'],
            ['nama' => 'Suami'],
            ['nama' => 'Istri'],
            ['nama' => 'Anak'],
            ['nama' => 'Menantu'],
            ['nama' => 'Cucu'],
            ['nama' => 'Orang Tua'],
            ['nama' => 'Mertua'],
            ['nama' => 'Famili Lain'],
            ['nama' => 'Pembantu'],
            ['nama' => 'Lainnya'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_hubungan');
    }
};
