<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeveloperTransMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('i_developer_trans', function (Blueprint $table) {
            $table->mediumText('description');
            $table->string('meta_title', 191)->nullable();
            $table->mediumText('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('i_developer_trans', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
}
