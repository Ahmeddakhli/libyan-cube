<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIDesignTypeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_design_type_trans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('i_design_type_id');
            $table->unsignedInteger('language_id');
            $table->string('type', 191);
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
        Schema::dropIfExists('i_design_type_trans');
    }
}
