<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBiFloorNumberIdToBiUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->integer('i_floor_number_id')->unsigned()->index()->nullable()->after('i_bathroom_id');
            $table->foreign('i_floor_number_id')->references('id')->on('i_floor_numbers');
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
            $table->dropForeign(['i_floor_number_id']);
            $table->dropColumn('i_floor_number_id');
        });
    }
}
