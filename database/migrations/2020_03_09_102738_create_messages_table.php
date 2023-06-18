<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sender_id')->unsigned()->index()->nullable();
            $table->foreign('sender_id')->references('id')->on('users');
            $table->integer('receiver_id')->unsigned()->index();
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->integer('i_unit_id')->unsigned()->index();
            $table->foreign('i_unit_id')->references('id')->on('i_units');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->mediumText('message');
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
        Schema::dropIfExists('messages');
    }
}
