<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiFurnishingStatusTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_furnishing_status_trans', function (Blueprint $table) {
            $table->integer('i_fur_status_id')->unsigned()->index();
            $table->foreign('i_fur_status_id')->references('id')->on('i_furnishing_statuses');
            $table->integer('language_id')->unsigned()->index();
            //$table->foreign('language_id')->references('id')->on('languages');
            $table->primary(['i_fur_status_id', 'language_id']);
            $table->string('furnishing_status', 191);
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
        Schema::dropIfExists('i_furnishing_status_trans');
    }
}
