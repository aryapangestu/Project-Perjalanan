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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id'
            $table->unsignedBigInteger('ride_id'); // membuat kolom 'ride_id'
            $table->integer('amount'); // membuat kolom 'amount'
            $table->string('type', 255); // membuat kolom 'type'
            $table->timestamps(); // membuat kolom waktu

            $table->foreign('ride_id')->references('id')->on('rides'); // membuat foreign key
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
        Schema::dropIfExists('payments');
    }
};
