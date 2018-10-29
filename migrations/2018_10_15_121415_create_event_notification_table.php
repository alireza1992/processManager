<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('step_id');
            $table->integer('process_id');
            $table->integer('status');
            $table->integer('log_count');
            $table->string('target');
            $table->integer('target_count');
            $table->text('body');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_notification');
    }
}
