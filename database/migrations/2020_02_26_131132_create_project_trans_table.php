<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_project_trans', function (Blueprint $table) {
            $table->integer('i_project_id')->unsigned()->index();
            $table->foreign('i_project_id')->references('id')->on('i_projects');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_project_id', 'language_id']);
            $table->string('project', 191);
            $table->mediumText('description');
            $table->timestamps();
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
        Schema::dropIfExists('i_project_trans');
    }
}
