<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticleComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articale_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('text');
            $table->integer('time');
            $table->integer('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_avatar')->nullable();
            $table->bigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('articale_comments');
    }
}
