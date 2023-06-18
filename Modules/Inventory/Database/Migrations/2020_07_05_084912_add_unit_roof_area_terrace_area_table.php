<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitRoofAreaTerraceAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->float('roof_area',12,2)->nullable()->after('i_area_unit_id');
            $table->float('terrace_area',12,2)->nullable()->after('i_area_unit_id');
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
            $table->dropColumn('roof_area');
            $table->dropColumn('terrace_area');
        });
    }
}
