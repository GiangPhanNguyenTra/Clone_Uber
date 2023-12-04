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
        Schema::create('tbl_driving_licenses', function (Blueprint $table) {
            $table->string('driving_license_id')->primary();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('class');
            $table->string('expires')->default('Không thời hạn');
            $table->date('beginning_date');
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
        Schema::dropIfExists('tbl_driving_licenses');
    }
};
