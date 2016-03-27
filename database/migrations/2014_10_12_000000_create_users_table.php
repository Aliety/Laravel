<?php

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
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('sex', ['male', 'female']);
            $table->timestamp('birthday');
            $table->string('grade');
            $table->string('college');
            $table->string('major');
            $table->string('tel');
            $table->text('profile');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
