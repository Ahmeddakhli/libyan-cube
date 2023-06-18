<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field', 191);
            $table->boolean('is_full_creation_hidden')->default(0);
            $table->boolean('is_fast_creation_hidden')->default(0);
            $table->boolean('is_full_edit_hidden')->default(0);
            $table->boolean('is_fast_edit_hidden')->default(0);
            $table->boolean('is_full_view_hidden')->default(0);
            $table->boolean('is_fast_view_hidden')->default(0);
            $table->boolean('is_required')->default(0);
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
        Schema::dropIfExists('i_config');
    }
}
