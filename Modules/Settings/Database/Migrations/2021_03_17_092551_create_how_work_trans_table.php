<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHowWorkTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_work_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('how_work_id')->index();
            $table->integer('language_id')->index();
            $table->string('title');
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('how_work_trans');
    }
}
