<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('full_name', 255)->nullable();
            $table->string('image', 255)->nullable();
            // $table->string('username', 191)->unique();
            $table->string('username', 191);
            // $table->string('email', 191)->unique();
            $table->string('email', 191);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('mobile_number', 255);
            $table->boolean('is_suspended')->default(0);
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip', 39)->nullable();
            $table->string('connection_id', 255)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
