<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('course_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('advert_categories')->onDelete('CASCADE');
            $table->string('name_ru');
            $table->string('name_uk');
            $table->string('type');
            $table->boolean('required');
            $table->json('variants');
            $table->integer('sort');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_attributes');
    }
}
