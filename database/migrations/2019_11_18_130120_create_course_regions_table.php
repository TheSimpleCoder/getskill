<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('course_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru')->unique();
            $table->string('name_uk')->unique();
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_regions');
    }
}
