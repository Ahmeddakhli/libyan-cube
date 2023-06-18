<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIFacilitiesDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_facility_trans', function (Blueprint $table) {
            $table->string('description',191)->nullable()->after('facility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_facility_trans', function (Blueprint $table) {
            $table->dropColumn('description');
        }); 
    }
}
