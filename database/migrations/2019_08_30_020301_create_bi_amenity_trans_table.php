<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiAmenityTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_amenity_trans', function (Blueprint $table) {
            $table->uuid('i_amenity_id')->index();
            $table->foreign('i_amenity_id')->references('id')->on('i_amenities');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_amenity_id', 'language_id']);
            $table->string('amenity', 191);
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
        Schema::dropIfExists('i_amenity_trans');
    }
}
