<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('organization_id');
            $table->string('name_ru');
            $table->string('name_ua');
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->integer('price_group')->nullable();
            $table->string('od_group')->nullable();
            $table->integer('sale_group')->nullable();
            $table->string('price_type_group')->nullable();
            $table->string('teachers')->nullable();
            $table->string('filia')->nullable();
            $table->string('finish')->nullable();
            $table->string('group_info')->nullable();
            $table->string('test_train')->nullable();
            $table->string('desc_ru')->nullable();
            $table->string('desc_ua')->nullable();
            $table->integer('status')->nullable();
            $table->string('modern_message')->nullable();
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
        Schema::dropIfExists('course_list');
    }
}
