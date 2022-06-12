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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('questionid')->unsigned()->default(null)->index();
            $table->integer('seqnr')->unsigned()->default(0)->index();
            $table->text('answertext')->nullable()->default(null);
            $table->mediumText('answerimage')->nullable()->default(null);
            $table->integer('answerwidth')->unsigned()->default(null);
            $table->integer('answerheight')->unsigned()->default(null);
            $table->boolean('correct')->default(false);
            
            $table->foreign('questionid')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
};
