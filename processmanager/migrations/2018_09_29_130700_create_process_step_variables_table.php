<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessStepVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_step_variables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('process_step_id');
            $table->string('name');
            $table->string('alias');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('process_step_variables');
    }
}
