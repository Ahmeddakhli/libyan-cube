<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIUnitDesignTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            $table->unsignedBigInteger('i_design_type_id')->nullable()->index();
            $table->foreign('i_design_type_id')->references('id')->on('i_design_types');
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
            $table->dropForeign(['i_design_type_id']);
            $table->dropColumn('i_design_type_id');
        });
    }
}
