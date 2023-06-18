<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiFloorNumberTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_floor_number_trans', function (Blueprint $table) {
            $table->integer('i_floor_number_id')->unsigned()->index();
            $table->foreign('i_floor_number_id')->references('id')->on('i_floor_numbers');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_floor_number_id', 'language_id']);
            $table->string('displayed_text', 191);
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
        Schema::dropIfExists('i_floor_number_trans');
    }
}
