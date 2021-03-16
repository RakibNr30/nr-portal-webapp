<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResidentialInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_residential_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('present_country')->nullable();
			$table->string('present_city')->nullable();
			$table->string('present_state')->nullable();
			$table->text('present_address_line_1')->nullable();
			$table->text('present_address_line_2')->nullable();
			$table->string('permanent_country')->nullable();
			$table->string('permanent_city')->nullable();
			$table->string('permanent_state')->nullable();
			$table->text('permanent_address_line_1')->nullable();
			$table->text('permanent_address_line_2')->nullable();
            $table->string('present_street_name')->nullable();
            $table->string('permanent_street_name')->nullable();
            $table->string('present_house_number')->nullable();
            $table->string('permanent_house_number')->nullable();
            $table->string('present_zip_code')->nullable();
            $table->string('permanent_zip_code')->nullable();
			$table->unsignedBigInteger('user_id');
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_residential_infos');
    }
}
