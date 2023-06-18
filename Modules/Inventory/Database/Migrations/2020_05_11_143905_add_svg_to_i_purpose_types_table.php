<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSvgToIPurposeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_purpose_types', function (Blueprint $table) {
            $table->mediumText('svg')->after('order')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_purpose_types', function (Blueprint $table) {
            $table->dropColumn('svg');
        });
    }
}
