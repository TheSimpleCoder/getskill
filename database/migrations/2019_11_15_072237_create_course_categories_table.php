<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCourseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_uk')->nullable(false);
            $table->string('name_ru')->nullable(false);
            $table->string('slug')->nullable(false)->unique();
            $table->text('description_uk')->nullable(true);
            $table->text('description_ru')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('meta_title_ru')->nullable(true);
            $table->string('meta_title_uk')->nullable(true);
            $table->string('meta_description_ru')->nullable(true);
            $table->string('meta_description_uk')->nullable(true);
            $table->string('meta_keywords_ru')->nullable(true);
            $table->string('meta_keywords_uk')->nullable(true);
            NestedSet::columns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_categories');
    }
}
