<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_trans', function (Blueprint $table) {
            $table->integer('seo_id')->unsigned()->index();
            $table->integer('language_id')->unsigned()->index();
            $table->primary(['seo_id', 'language_id']);
            $table->string('title')->nullable();
            $table->string('key_words')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('short_description')->nullable();
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
        Schema::dropIfExists('seo_trans');
    }
}
