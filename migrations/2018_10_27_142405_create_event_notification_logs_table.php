<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_notification_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id');
            $table->integer('contact');
            $table->integer('user_id');
            $table->integer('body');
            $table->integer('mode');
            $table->integer('target_mode');
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
        Schema::dropIfExists('event_notification_logs');

    }
}
