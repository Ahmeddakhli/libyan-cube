<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiOfferingTypeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_offering_type_trans', function (Blueprint $table) {
            $table->integer('i_offering_type_id')->unsigned()->index();
            $table->foreign('i_offering_type_id')->references('id')->on('i_offering_types');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_offering_type_id', 'language_id']);
            $table->string('offering_type', 191);
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
        Schema::dropIfExists('i_offering_type_trans');
    }
}
