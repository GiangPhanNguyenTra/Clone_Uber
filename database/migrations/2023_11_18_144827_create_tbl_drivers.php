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
        Schema::create('tbl_drivers', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avata')->nullable();
            $table->integer('phone');
            $table->string('address');
            $table->boolean('verify')->default(0);
            $table->string('gender', 5);
            $table->string('password');
            $table->integer('status_code')->default(0);
            $table->string('status_description')->default('free');
            $table->string('verify_token')->nullable();
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
        Schema::dropIfExists('tbl_drivers');
    }
};
