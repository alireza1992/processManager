<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventNotificationTargetInProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_notification_target_inProcesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id');
            $table->integer('step_id');
            $table->integer('mode');
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
        Schema::dropIfExists('event_notification_target_inProcesses');

    }
}
