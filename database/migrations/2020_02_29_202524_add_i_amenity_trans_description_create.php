<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIAmenityTransDescriptionCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_amenity_trans', function (Blueprint $table) {
            $table->mediumText('description')->nullable()->after('amenity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_amenity_trans', function (Blueprint $table) {
            $table->dropColumn('description');
        }); 
    }
}
