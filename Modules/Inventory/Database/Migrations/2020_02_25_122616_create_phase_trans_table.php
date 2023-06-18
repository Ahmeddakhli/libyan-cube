<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhaseTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_phase_trans', function (Blueprint $table) {
            $table->integer('i_phase_id')->unsigned()->index();
            $table->foreign('i_phase_id')->references('id')->on('i_phases');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_phase_id', 'language_id']);
            $table->string('name', 191);
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
        Schema::dropIfExists('i_phase_trans');
    }
}
