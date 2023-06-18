<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('blog_id')->unsigned()->index();
            $table->foreign('blog_id')->references('id')->on('blogs');
            $table->unsignedBigInteger('blog_category_id')->index();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories');
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
        Schema::dropIfExists('blogs_categories');
    }
}
