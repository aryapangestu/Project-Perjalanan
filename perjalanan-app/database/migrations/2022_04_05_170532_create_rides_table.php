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
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('passenger_id');
            $table->double('pick_up_form_latitude', 15, 8)->default(null);
            $table->double('pick_up_form_longitude', 15, 8)->default(null);
            $table->double('drop_to_latitude', 15, 8)->default(null);
            $table->double('drop_to_longitude', 15, 8)->default(null);
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('driver_id')->references('user_id')->on('drivers');
            $table->foreign('passenger_id')->references('user_id')->on('passengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rides');
    }
};
