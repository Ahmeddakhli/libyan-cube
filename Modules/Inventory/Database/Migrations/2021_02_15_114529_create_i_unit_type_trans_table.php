<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIUnitTypeTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_unit_type_trans', function (Blueprint $table) {
            $table->integer('i_unit_type_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['i_unit_type_id', 'language_id']);
            $table->string('unit_type', 191);
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
        Schema::dropIfExists('i_unit_type_trans');
    }
}
