<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventNotificationTargetUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_notification_target_user_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id');
            $table->integer('group_id');
            $table->integer('group_mode');
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
        Schema::dropIfExists('event_notification_target_user_groups');

    }
}
