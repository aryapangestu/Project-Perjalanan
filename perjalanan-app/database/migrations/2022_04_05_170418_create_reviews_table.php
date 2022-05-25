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
            $table->unsignedBigInteger('driver_id'); // membuat kolom 'driver_id'
            $table->unsignedBigInteger('passenger_id'); // membuat kolom 'passenger_id'
            $table->integer('rate'); // membuat kolom 'rate'
            $table->string('review', 255); // membuat kolom 'review' dengan maksimal 255 character
            $table->timestamps(); // membuat kolom 'waktu'

            $table->foreign('driver_id')->references('user_id')->on('drivers'); // Membuat Foreign key
            $table->foreign('passenger_id')->references('user_id')->on('passengers'); // Membuat Foreign key
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
