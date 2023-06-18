<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogosUserStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logos', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('created_at');
            $table->unsignedBigInteger('updated_by')->nullable()->after('updated_at');
            $table->unsignedBigInteger('deleted_by')->nullable()->after('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logos', function (Blueprint $table) {
        });
    }
}
