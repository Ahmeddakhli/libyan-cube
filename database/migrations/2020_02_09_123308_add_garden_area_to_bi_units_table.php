<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGardenAreaToBiUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->integer('garden_area')->nullable()->after('area');
            $table->integer('i_garden_area_unit_id')->unsigned()->index()->nullable()->after('i_area_unit_id');
            $table->foreign('i_garden_area_unit_id')->references('id')->on('i_area_units');
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
            $table->dropColumn('garden_area');
            $table->dropForeign(['i_garden_area_unit_id']);
            $table->dropColumn('i_garden_area_unit_id');
        });
    }
}
