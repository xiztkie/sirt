<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->primary();
            $table->string('nama_daerah');
            $table->string('alamat');
            $table->string('kode_pos', 10); 
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('email');
            $table->string('no_telp', 20);
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE settings ADD CONSTRAINT cek_satu_baris CHECK (id = 1)');
        DB::table('settings')->insert([
            'id'             => 1, // Wajib 1
            'nama_daerah'    => 'RT 01 / RW 01',
            'alamat'         => 'Jl. Mawar Merah No. 10',
            'kode_pos'       => '12345',
            'kecamatan'      => 'Kecamatan Contoh',
            'kabupaten_kota' => 'Kota Contoh',
            'provinsi'       => 'Provinsi Contoh',
            'email'          => 'admin@rt01.com',
            'no_telp'        => '081234567890',
            'logo'           => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
