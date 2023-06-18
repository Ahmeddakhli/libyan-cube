<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_socials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('top_agent_id')->index();
            $table->foreign('top_agent_id')->references('id')->on('top_agents');
            $table->string('link');
            $table->string('icon');
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
        Schema::dropIfExists('agent_socials');
    }
}
