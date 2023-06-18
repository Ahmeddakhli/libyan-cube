<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangingDescriptionToIProjectsTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_project_trans', function (Blueprint $table) {
            $table->mediumText('landing_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_project_trans', function (Blueprint $table) {
            $table->dropColumn('landing_description');
        });
    }
}
