<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiAmenitablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_amenitables', function (Blueprint $table) {
            $table->uuid('b_i_amenity_id')->index();
            $table->foreign('b_i_amenity_id')->references('id')->on('i_amenities');
            $table->morphs('i_amenitable');
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
        Schema::dropIfExists('i_amenitables');
    }
}
