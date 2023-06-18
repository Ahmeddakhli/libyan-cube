<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDoubleValuesInIUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_units', function (Blueprint $table) {
            // $table->double('area', 12, 2)->nullable()->change();
            // $table->double('plot_area', 12, 2)->nullable()->change();
            // $table->double('build_up_area', 12, 2)->nullable()->change();
            // $table->double('garden_area', 12, 2)->nullable()->change();

            DB::statement('ALTER TABLE i_units MODIFY COLUMN area double(12, 2) NULL');
            DB::statement('ALTER TABLE i_units MODIFY COLUMN plot_area double(12, 2) NULL');
            DB::statement('ALTER TABLE i_units MODIFY COLUMN build_up_area double(12, 2) NULL');
            DB::statement('ALTER TABLE i_units MODIFY COLUMN garden_area double(12, 2) NULL');
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
            $table->integer('area')->nullable()->change();
            $table->integer('plot_area')->nullable()->change();
            $table->integer('build_up_area')->nullable()->change();
            $table->integer('garden_area')->nullable()->change();
        });
    }
}
