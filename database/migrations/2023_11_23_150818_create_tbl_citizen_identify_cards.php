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
        Schema::create('tbl_citizen_identify_cards', function (Blueprint $table) {
            $table->string('citizen_identify_card_id')->primary();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('gender', 5);
            $table->string('place_of_origin');
            $table->string('place_of_residence');
            $table->date('date_of_expiry');
            $table->date('date_of_issue');
            $table->string('issued_by');
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
        Schema::dropIfExists('tbl_citizen_identify_cards');
    }
};
