<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResalRentPriceToIUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->integer('resale_price')->nullable();
            $table->integer('rent_price')->nullable();
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
            $table->dropForeign(['resale_price']);
            $table->dropColumn('rent_price');
        });
    }
}
