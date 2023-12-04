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
        Schema::create('tbl_rides', function (Blueprint $table) {
            $table->Increments('ride_id');
            $table->string('start_location_name');
            $table->double('start_location_lat');
            $table->double('start_location_lng');
            $table->string('end_location_name');
            $table->double('end_location_lat');
            $table->double('end_location_lng');
            $table->double('distance');
            $table->double('price');
            $table->integer('status_code')->default(0);
            $table->string('status_description')->default('waiting for driver');
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->integer('rating')->nullable();
            $table->string('comment')->nullable();
            $table->integer('driver_id')->nullable();
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_rides');
    }
};
