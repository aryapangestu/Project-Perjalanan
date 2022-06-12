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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable(); // membuat kolom 'driver_id
            $table->unsignedBigInteger('passenger_id');
            $table->string('vehicle_type')->default(null); // membuat kolom 'passenger_id'
            $table->double('pick_up_form_latitude', 15, 8); // membuat kolom 'pick_up form latitude'
            $table->double('pick_up_form_longitude', 15, 8); // membuat kolom 'pick_up form longitude'
            $table->double('drop_to_latitude', 15, 8); // membuat kolom 'drop_up form latitude'
            $table->double('drop_to_longitude', 15, 8); // membuat kolom 'drop_up form longitude'
            $table->integer('amount'); // membuat kolom 'amount'
            $table->integer('status')->default(0);
            $table->timestamps(); // membuat kolom waktu

            $table->foreign('driver_id')->references('user_id')->on('drivers'); // membuat foreign key
            $table->foreign('passenger_id')->references('user_id')->on('passengers'); // membuat foreign key
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
        Schema::dropIfExists('rides');
    }
};
