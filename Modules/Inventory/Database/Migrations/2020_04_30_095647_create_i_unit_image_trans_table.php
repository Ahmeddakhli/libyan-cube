<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIUnitImageTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_unit_image_trans', function (Blueprint $table) {
            $table->bigInteger('i_unit_image_id')->unsigned()->index();
            $table->foreign('i_unit_image_id')->references('id')->on('i_unit_images');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_unit_image_id', 'language_id']);
            $table->string('title');
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
        Schema::dropIfExists('i_unit_image_trans');
    }
}
