<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForignKeyToIUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->dropForeign(['i_unit_type_id']);
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
            $table->foreign('i_unit_type_id')->references('id')->on('i_design_types');
        });
    }
}
