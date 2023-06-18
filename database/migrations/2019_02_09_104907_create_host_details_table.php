<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('host_details', function (Blueprint $table) {
            $table->bigIncrements('id');
	    // $table->string('fqdn', 191)->unique();
            $table->string('fqdn', 191);
            $table->integer('package_id')->unsigned()->index();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('owner_email', 191);
            $table->string('owner_mobile_number', 191);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('host_details');
    }
}
