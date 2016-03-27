<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('college');
            $table->string('major');
            $table->string('title');
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
        Schema::drop('teachers');
    }
}
