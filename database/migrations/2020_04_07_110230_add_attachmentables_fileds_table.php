<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttachmentablesFiledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachmentables', function (Blueprint $table) {
            $table->bigInteger('size');
            $table->string('file_name');
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachmentables', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->dropColumn('file_name');
            $table->dropColumn('order');
        });
    }
}
