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
        Schema::create('passengers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Membuat kolom 'user_id'
            $table->integer('wallet_balance',)->default('0'); // Membuat kolom 'wallet_balance' dengan nilai awal '0'
            $table->integer('total_rides',)->default('0'); // Membuat kolom 'total_rides' dengan nilai awal '0'
            $table->timestamps(); // Membuat kolom 'waktu'

            $table->foreign('user_id')->references('id')->on('users'); // Membuat Foreign Key
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
        Schema::dropIfExists('passengers');
    }
};
