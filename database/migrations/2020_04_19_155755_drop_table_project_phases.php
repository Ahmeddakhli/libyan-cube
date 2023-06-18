<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableProjectPhases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('project_phases');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('project_phases', function (Blueprint $table) {
            $table->integer('i_phase_id')->unsigned()->index();
            $table->foreign('i_phase_id')->references('id')->on('i_phases');
            $table->integer('project_id')->unsigned()->index();
            $table->foreign('project_id')->references('id')->on('i_projects');
            $table->primary(['i_phase_id', 'project_id']);
            $table->timestamps();
        });
    }
}
