<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiAreaUnitTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_area_unit_trans', function (Blueprint $table) {
            $table->integer('i_area_unit_id')->unsigned()->index();
            $table->foreign('i_area_unit_id')->references('id')->on('i_area_units');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_area_unit_id', 'language_id']);
            $table->string('area_unit', 191);
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
        Schema::dropIfExists('i_area_unit_trans');
    }
}
