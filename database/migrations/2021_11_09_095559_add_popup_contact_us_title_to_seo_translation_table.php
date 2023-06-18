<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPopupContactUsTitleToSeoTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seo_trans', function (Blueprint $table) {
            $table->string('popup_contact_us_title')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seo_trans', function (Blueprint $table) {
            $table->dropColumn('popup_contact_us_title');
        });
    }
}
