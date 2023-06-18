<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDoubleValuesInIProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            // $table->double('area_from', 12, 2)->nullable()->change();
            // $table->double('area_to', 12, 2)->nullable()->change();

            DB::statement('ALTER TABLE i_projects MODIFY COLUMN area_from double(12, 2) NULL');
            DB::statement('ALTER TABLE i_projects MODIFY COLUMN area_to double(12, 2) NULL');
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
            $table->integer('area_from')->nullable()->change();
            $table->integer('area_to')->nullable()->change();
        });
    }
}
