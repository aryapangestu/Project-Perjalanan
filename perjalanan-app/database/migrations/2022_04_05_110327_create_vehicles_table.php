<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id'
            $table->string('model',); // MEmbuat kolom 'model'
            $table->string('plat'); // Membuat kolom 'plat'
            $table->boolean('jenis'); // Memebuat kolom 'jenis'
            $table->timestamps(); // membuat kolom waktu
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // Fungsi DOWN untuk mengembalikan semua operasi yg dilakukan oleh UP
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
