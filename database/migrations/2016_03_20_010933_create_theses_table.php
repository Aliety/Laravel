<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('original_name');
            $table->text('save_name');
            $table->integer('topic_id')->unsigned();
            $table->string('save_folder');
            $table->timestamps();
        });

        Schema::table('theses', function (Blueprint $table) {
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('theses');
    }
}
