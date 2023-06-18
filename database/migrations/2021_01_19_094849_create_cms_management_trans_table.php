<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsManagementTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_management_trans', function (Blueprint $table) {
            $table->unsignedBigInteger('cms_management_id')->index();
            $table->foreign('cms_management_id')->references('id')->on('cms_managements');
            $table->unsignedInteger('language_id')->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->string('title');
            $table->mediumText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_management_trans');
    }
}
