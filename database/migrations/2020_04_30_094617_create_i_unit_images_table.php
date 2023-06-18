<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIUnitImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_unit_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('link');
            $table->integer('i_unit_id')->unsigned()->index();
            $table->foreign('i_unit_id')->references('id')->on('i_units');
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
        Schema::dropIfExists('i_unit_images');
    }
}
