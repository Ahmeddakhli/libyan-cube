<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaFiledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->index()->nullable();
            $table->foreign('area_id')->references('id')->on('locations');
        });

        Schema::table('i_units', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->index()->nullable();
            $table->foreign('area_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });

        Schema::table('i_units', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
}
