<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSellRequestIPurposeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_sell_requests', function (Blueprint $table) {
            $table->mediumText('comments')->nullable()->change();
            $table->integer('i_purpose_id')->unsigned()->index()->after('compound');
            $table->foreign('i_purpose_id')->references('id')->on('i_purposes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_sell_requests', function (Blueprint $table) {
            $table->dropForeign(['i_purpose_id']);
            $table->dropColumn('i_purpose_id');
        });
    }
}
