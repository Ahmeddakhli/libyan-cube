<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_developer_trans', function (Blueprint $table) {
            $table->integer('i_developer_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['i_developer_id', 'language_id']);
            $table->string('developer', 191);
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
        Schema::dropIfExists('i_developer_trans');
    }
}
