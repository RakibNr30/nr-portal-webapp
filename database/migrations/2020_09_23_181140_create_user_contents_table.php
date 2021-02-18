<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
			$table->longText('description')->nullable();
			$table->integer('proficiency')->default(0);
			$table->integer('content_category_id')->default(0);
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
        Schema::dropIfExists('user_contents');
    }
}
