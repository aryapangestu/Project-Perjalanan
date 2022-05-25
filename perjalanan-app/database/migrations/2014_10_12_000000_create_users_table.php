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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id'
            $table->string('name'); // MEmbuat kolom 'nama'
            $table->string('email')->unique(); // Membuat kolom 'email'
            $table->string('password'); // Membuat kolom 'password'
            $table->integer('role',)->default('1'); // Membuat kolom 'role'
            $table->integer('status',)->default('1'); // Membuat kolom 'status'
            $table->timestamps(); // Membuat kolom 'waktu'
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
        Schema::dropIfExists('users');
    }
};
