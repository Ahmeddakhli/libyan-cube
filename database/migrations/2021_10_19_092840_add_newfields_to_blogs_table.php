<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewfieldsToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->mediumText('video')->nullable()->after('slug');
            $table->timestamp('published_at')->nullable()->after('created_at');
            $table->unsignedBigInteger('published_by')->nullable()->after('created_by');
        });

        Schema::table('blog_trans', function (Blueprint $table) {
            $table->mediumText('excerpt')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('video');
            $table->dropColumn('published_at');
            $table->dropColumn('published_by');
        });

        Schema::table('blog_trans', function (Blueprint $table) {
            $table->dropColumn('excerpt');
        });
    }
}
