<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiPositionTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_position_trans', function (Blueprint $table) {
            $table->integer('i_position_id')->unsigned()->index();
            $table->foreign('i_position_id')->references('id')->on('i_positions');
            $table->integer('language_id')->unsigned()->index();
            // //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_position_id', 'language_id']);
            $table->string('position', 191);
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
        Schema::dropIfExists('i_position_trans');
    }
}
