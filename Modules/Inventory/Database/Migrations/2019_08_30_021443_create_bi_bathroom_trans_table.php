<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiBathroomTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_bathroom_trans', function (Blueprint $table) {
            $table->integer('i_bathroom_id')->unsigned()->index();
            $table->foreign('i_bathroom_id')->references('id')->on('i_bathrooms');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_bathroom_id', 'language_id']);
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
        Schema::dropIfExists('i_bathroom_trans');
    }
}
