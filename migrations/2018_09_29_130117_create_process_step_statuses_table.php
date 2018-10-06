<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessStepStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_step_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_step_id');
            $table->tinyInteger('status_code');
            $table->string('status_name');
            $table->text('message');
            $table->string('alias');
            $table->nullableTimestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_step_statuses');
    }
}
