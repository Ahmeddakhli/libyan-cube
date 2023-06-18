<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiFacilitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_facilitables', function (Blueprint $table) {
            $table->uuid('b_i_facility_id')->index();
            $table->foreign('b_i_facility_id')->references('id')->on('i_facilities');
            $table->morphs('i_facilitable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('i_facilitables');
    }
}
