<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('developer_id')->unsigned()->index()->nullable();
            $table->foreign('developer_id')->references('id')->on('i_developers');
            $table->string('project', 191);
            $table->timestamp('delivery_date')->nullable();
            $table->boolean('finished_status')->default(0);
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
        Schema::dropIfExists('i_projects');
    }
}
