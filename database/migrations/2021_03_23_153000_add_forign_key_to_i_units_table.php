<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForignKeyToIUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->unsignedInteger('i_unit_type_id')->change();
            $table->foreign('i_unit_type_id')->references('id')->on('i_unit_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->unsignedBigInteger('i_unit_type_id')->change();
            $table->foreign('i_unit_type_id')->references('id')->on('i_design_types');
        });
    }
}
