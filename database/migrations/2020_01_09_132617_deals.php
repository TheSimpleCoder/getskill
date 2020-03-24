<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Deals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('organization_id');
            $table->integer('course_id')->nullable();
            $table->string('name_deal')->nullable();
            $table->string('name_user')->nullable();
            $table->string('phone_user')->nullable();
            $table->string('email_user')->nullable();
            $table->integer('time');
            $table->integer('status')->default(0);
            $table->integer('tag')->nullable();
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
        Schema::dropIfExists('deals');
    }
}
