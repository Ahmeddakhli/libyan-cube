<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_modules', function (Blueprint $table) {
            $table->integer('package_id')->unsigned()->index();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->integer('module_id')->unsigned()->index();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_modules');
    }
}
