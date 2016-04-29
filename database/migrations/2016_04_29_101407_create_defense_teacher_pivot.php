<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefenseTeacherPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defense_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('defense_id')->unsigned()->index();
            $table->integer('teacher_id')->unsigned()->index();
            $table->text('advice');
            $table->string('score');
            $table->string('role');
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
        Schema::drop('defense_teacher');
    }
}
