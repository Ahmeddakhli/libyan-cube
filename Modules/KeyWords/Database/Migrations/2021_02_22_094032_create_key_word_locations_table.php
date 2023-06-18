<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyWordLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_word_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('key_word_id')->index();
            $table->foreign('key_word_id')->references('id')->on('key_words');
            $table->unsignedInteger('location_id')->index();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('type');
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
        Schema::dropIfExists('key_word_locations');
    }
}
