<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyWordTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_word_trans', function (Blueprint $table) {
            $table->integer('key_word_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['key_word_id', 'language_id']);
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
        Schema::dropIfExists('key_word_trans');
    }
}
