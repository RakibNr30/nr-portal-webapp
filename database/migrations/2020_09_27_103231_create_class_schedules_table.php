<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('program_id');
			$table->unsignedBigInteger('semester_id');
			$table->unsignedBigInteger('session_id');
			$table->unsignedBigInteger('course_id');
			$table->unsignedBigInteger('teacher_id');
			$table->time('start_time');
			$table->time('end_time');
			$table->string('room_no');
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
        Schema::dropIfExists('class_schedules');
    }
}
