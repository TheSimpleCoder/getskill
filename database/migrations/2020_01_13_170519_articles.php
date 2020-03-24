<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru');
            $table->string('name_ua');
            $table->mediumText('content_ru');
            $table->mediumText('content_ua');
            $table->integer('cat_id');
            $table->integer('cat_course_id')->nullable();
            $table->integer('time');
            $table->bigInteger('views')->nullable();
            $table->string('seo_name_ru')->nullable();
            $table->string('seo_name_ua')->nullable();
            $table->string('seo_desc_ru')->nullable();
            $table->string('seo_desc_ua')->nullable();
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
        Schema::dropIfExists('articales');
    }
}
