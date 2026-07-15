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
        Schema::create('tipe_bangunans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        DB::table('tipe_bangunans')->insert([
            ['nama' => 'Rumah'],
            ['nama' => 'Gedung'],
            ['nama' => 'Kantor'],
            ['nama' => 'Tempat Ibadah'],
            ['nama' => 'Rumah Dinas'],
            ['nama' => 'Rumah Sewa'],
            ['nama' => 'Kos'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_bangunans');
    }
};
