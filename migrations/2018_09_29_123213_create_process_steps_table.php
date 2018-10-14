<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_id');
            $table->string('name');
            $table->tinyInteger('priority');
            $table->string('alias');
            $table->tinyInteger('presenter_group_id');
            $table->tinyInteger('group_mode')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('process_steps');
    }
}
