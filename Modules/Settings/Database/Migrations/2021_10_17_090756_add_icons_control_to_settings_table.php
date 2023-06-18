<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconsControlToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('active_whatsapp_icon')->default(1);
            $table->boolean('active_messanger_icon')->default(1);
            $table->boolean('active_phone_icon')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('active_whatsapp_icon');
            $table->dropColumn('active_messanger_icon');
            $table->dropColumn('active_phone_icon');
        });
    }
}
