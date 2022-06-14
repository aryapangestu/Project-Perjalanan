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
        Schema::create('drivers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Membuat kolom 'user_id'
            $table->unsignedBigInteger('vehicle_id'); // Membuat Kolom 'vehicle_id'
            $table->integer('earnings',)->default('0'); // Membuat Kolom 'earnings' dan nilai awal '0'
            $table->boolean('ride_status')->default('0'); // Membuat Kolom 'ride_status' dan nilai awal '0'
            $table->timestamps(); // membuat kolom waktu

            $table->foreign('user_id')->references('id')->on('users'); // membuat Foreign Key
            $table->foreign('vehicle_id')->references('id')->on('vehicles'); // membuat Foreign Key
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
        Schema::dropIfExists('drivers');
    }
};
