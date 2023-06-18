<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIDevelopersLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_developers', function (Blueprint $table) {
            $table->integer('country_id')->unsigned()->index()->nullable();
            $table->foreign('country_id')->references('id')->on('locations');
            $table->integer('region_id')->unsigned()->index()->nullable();
            $table->foreign('region_id')->references('id')->on('locations');
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->foreign('city_id')->references('id')->on('locations');
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
        Schema::table('i_developers', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
}
