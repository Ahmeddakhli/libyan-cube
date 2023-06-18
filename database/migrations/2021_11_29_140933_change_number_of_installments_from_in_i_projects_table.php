<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNumberOfInstallmentsFromInIProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_projects', function (Blueprint $table) {
            $table->float('number_of_installments_from', 12, 2)->change();
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
            $table->dropColumn('number_of_installments_from');
        });
    }
}
