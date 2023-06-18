<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAmenitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_facilitables', function (Blueprint $table) {
            $table->renameColumn('b_i_facility_id','i_facility_id');
        });

        Schema::table('i_amenitables', function (Blueprint $table) {
            $table->renameColumn('b_i_amenity_id','i_amenity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_facilitables', function (Blueprint $table) {
            $table->renameColumn('i_facility_id','b_i_facility_id');
        });

        Schema::table('i_amenitables', function (Blueprint $table) {
            $table->renameColumn('i_amenity_id','b_i_amenity_id');
        });
    }
}
