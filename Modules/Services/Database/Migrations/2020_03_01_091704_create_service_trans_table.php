<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_trans', function (Blueprint $table) {
            $table->integer('service_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['service_id', 'language_id']);
            $table->string('title');
            $table->text('description');
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
        Schema::dropIfExists('service_trans');
    }
}
