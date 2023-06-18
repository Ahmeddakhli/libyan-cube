<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorClassToBiFurnishingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_furnishing_statuses', function (Blueprint $table) {
            $table->string('color_class', 191)->nullable()->after('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_furnishing_statuses', function (Blueprint $table) {
            $table->dropColumn('color_class');
        });
    }
}
