<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categories_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->string('title', 250);
            $table->string('alias', 250);
            $table->text('description');
            $table->string('short_description', 1000);
            $table->string('meta_description', 1000);
            $table->integer('user_id')->unsigned();
            $table->integer('hits');
            $table->integer('likes');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
