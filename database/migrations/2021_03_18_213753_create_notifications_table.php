<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('notification_to')->nullable();
            $table->unsignedBigInteger('notification_from')->nullable();
            $table->string('notification_to_type')->nullable();
            $table->string('notification_from_type')->nullable();
            $table->longText('message');
            $table->string('status');
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
        Schema::dropIfExists('notifications');
    }
}
