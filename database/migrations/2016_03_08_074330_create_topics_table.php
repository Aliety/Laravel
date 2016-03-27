<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id');
            $table->string('name');
            $table->string('college');
            $table->string('grade');
            $table->string('content');
            $table->string('type');
            $table->string('place');
            $table->integer('week');
            $table->integer('number');
            $table->string('level');
            $table->string('requirement');
            $table->text('profile');
            $table->timestamps();
        });

        Schema::table('topics', function (Blueprint $table) {
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topics');
    }
}
