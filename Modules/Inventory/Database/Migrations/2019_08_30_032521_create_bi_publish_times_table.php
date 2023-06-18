<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiPublishTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_publish_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('i_unit_id')->unsigned()->index();
            $table->foreign('i_unit_id')->references('id')->on('i_units');
            $table->timestamp('from')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('to')->nullable();
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
        Schema::dropIfExists('i_publish_times');
    }
}
