<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIprojectsNewFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            $table->mediumText('description')->nullable()->after('finished_status');
            $table->integer('country_id')->unsigned()->index()->nullable()->after('finished_status');
            $table->foreign('country_id')->references('id')->on('locations');
            $table->integer('region_id')->unsigned()->index()->nullable()->after('country_id');
            $table->foreign('region_id')->references('id')->on('locations');
            $table->integer('city_id')->unsigned()->index()->nullable()->after('region_id');
            $table->foreign('city_id')->references('id')->on('locations');
            $table->string('latitude', 191)->nullable()->after('city_id');
            $table->string('longitude', 191)->nullable()->after('latitude');
            $table->mediumText('address')->nullable()->after('longitude');
            $table->integer('i_area_unit_id')->unsigned()->index()->nullable()->after('address');
            $table->foreign('i_area_unit_id')->references('id')->on('i_area_units');
            $table->integer('area_from')->nullable()->after('i_area_unit_id');
            $table->integer('area_to')->nullable()->after('area_from');
            $table->integer('price_from')->nullable()->after('area_to');
            $table->integer('price_to')->nullable()->after('price_from');
            $table->string('currency_code', 191)->index()->nullable()->after('price_to');
            $table->integer('down_payment_from')->nullable()->after('currency_code');
            $table->integer('down_payment_to')->nullable()->after('down_payment_from');
            $table->integer('number_of_installments_from')->nullable()->after('down_payment_to');
            $table->integer('number_of_installments_to')->nullable()->after('number_of_installments_from');
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
            $table->dropColumn('description');
            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('address');
            $table->dropForeign(['i_area_unit_id']);
            $table->dropColumn('i_area_unit_id');
            $table->dropColumn('area_from');
            $table->dropColumn('area_to');
            $table->dropColumn('price_from');
            $table->dropColumn('price_to');
            $table->dropColumn('currency_code');
            $table->dropColumn('down_payment_from');
            $table->dropColumn('down_payment_to');
            $table->dropColumn('number_of_installments_from');
            $table->dropColumn('number_of_installments_to');
        });
    }
}
