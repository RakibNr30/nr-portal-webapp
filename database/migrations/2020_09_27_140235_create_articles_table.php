<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
			$table->longText('description')->nullable();
			$table->boolean('approve_status')->default(0);
			$table->timestamp('approved_at')->nullable();
			$table->unsignedBigInteger('approved_by')->nullable();
			$table->unsignedBigInteger('article_category_id');
			$table->unsignedBigInteger('author_id');
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
        Schema::dropIfExists('articles');
    }
}
