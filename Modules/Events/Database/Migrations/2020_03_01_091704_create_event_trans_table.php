<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_trans', function (Blueprint $table) {
            $table->integer('event_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['event_id', 'language_id']);
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->text('description');
            $table->mediumText('meta_description')->nullable();
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
        Schema::dropIfExists('event_trans');
    }
}
