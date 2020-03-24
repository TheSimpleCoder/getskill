<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Masters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('organization_id');
            $table->string('name_ru');
            $table->string('name_ua');
            $table->integer('type');
            $table->string('category');
            $table->integer('price');
            $table->integer('currency');
            $table->integer('price_about');
            $table->integer('price_type');
            $table->integer('date');
            $table->string('teachers');
            $table->string('filia');
            $table->string('regions');
            $table->integer('finish');
            $table->string('desc_ru')->nullable();
            $table->string('desc_ua')->nullable();
            $table->string('img')->nullable();
            $table->integer('rait')->default('0');
            $table->integer('view')->default('0');
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
        Schema::dropIfExists('masters_list');
    }
}
