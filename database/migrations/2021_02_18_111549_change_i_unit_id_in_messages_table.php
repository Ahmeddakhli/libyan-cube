<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIUnitIdInMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['i_unit_id']);
            $table->renameColumn('i_unit_id','i_project_id');
            $table->foreign('i_project_id')->references('id')->on('i_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['i_project_id']);
            $table->renameColumn('i_project_id','i_unit_id');
            $table->foreign('i_unit_id')->references('id')->on('i_units');
        });
    }
}
