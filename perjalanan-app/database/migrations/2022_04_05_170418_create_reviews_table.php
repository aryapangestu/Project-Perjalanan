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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // membuat kolom 'id'
            $table->integer('rate'); // membuat kolom 'rate'
            $table->string('review', 255); // membuat kolom 'review' dengan maksimal 255 character
            $table->timestamps(); // membuat kolom 'waktu'
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
        Schema::dropIfExists('reviews');
    }
};
