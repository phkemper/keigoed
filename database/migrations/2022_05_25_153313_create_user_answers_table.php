<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('userid')->unsigned()->default(null)->index();
            $table->bigInteger('answerid')->unsigned()->default(null)->index();
            $table->integer('millis')->unsigned()->default(null);
            
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('answerid')->references('id')->on('answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_answers');
    }
};
