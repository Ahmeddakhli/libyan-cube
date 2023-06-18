<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyWordTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_word_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('key_word_id')->index();
            $table->foreign('key_word_id')->references('id')->on('key_words');
            $table->unsignedInteger('type_id')->index();
            $table->foreign('type_id')->references('id')->on('i_purposes');
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
        Schema::dropIfExists('key_word_types');
    }
}
