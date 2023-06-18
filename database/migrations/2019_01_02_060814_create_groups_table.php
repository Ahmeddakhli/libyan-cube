<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('groups');
            // $table->string('name', 191)->unique();
            $table->string('name', 191);
            // $table->string('slug', 191)->unique();
            $table->string('slug', 191);
            $table->string('description')->nullable();
            $table->tinyInteger('is_hidden')->default(0);
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
        Schema::dropIfExists('groups');
    }
}
