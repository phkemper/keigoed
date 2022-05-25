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
        Schema::create('user_quizzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('userid')->unsigned()->default(null)->index();
            $table->bigInteger('quizid')->unsigned()->default(null)->index();
            $table->bigInteger('roleid')->unsigned()->default(null)->index();
            
            $table->unique(['userid','quizid','roleid']);
            
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('quizid')->references('id')->on('quizzes');
            $table->foreign('roleid')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_quizzes');
    }
};
