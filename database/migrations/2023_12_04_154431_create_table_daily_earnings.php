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
        Schema::create('table_daily_earnings', function (Blueprint $table) {
            $table->Increments('daily_earnings_id');
            $table->integer('total_rides')->nullable();
            $table->double('total_earnings')->nullable();
            $table->date('date')->nullable();
            $table->integer('driver_id');
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
        Schema::dropIfExists('table_daily_earnings');
    }
};
