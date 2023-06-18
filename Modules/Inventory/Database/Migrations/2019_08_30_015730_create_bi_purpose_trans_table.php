<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiPurposeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_purpose_trans', function (Blueprint $table) {
            $table->integer('i_purpose_id')->unsigned()->index();
            $table->foreign('i_purpose_id')->references('id')->on('i_purposes');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_purpose_id', 'language_id']);
            $table->string('purpose', 191);
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
        Schema::dropIfExists('i_purpose_trans');
    }
}
