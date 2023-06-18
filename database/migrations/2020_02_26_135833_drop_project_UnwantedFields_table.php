<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProjectUnwantedFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            $table->dropColumn('project');
            $table->dropColumn('description');
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
            $table->string('project', 191);
            $table->mediumText('description')->nullable()->after('finished_status');
        }); 
    }
}
