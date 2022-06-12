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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('quizid')->unsigned()->default(null)->index();
            $table->integer('seqnr')->unsigned()->default(0)->index();
            $table->text('questiontext')->nullable()->default(null);
            $table->mediumText('questionimage')->nullable()->default(null);
            $table->integer('questionwidth')->unsigned()->default(null);
            $table->integer('questionheight')->unsigned()->default(null);
            $table->text('explaintext')->nullable()->default(null);
            $table->mediumText('explainimage')->nullable()->default(null);
            $table->integer('explainwidth')->unsigned()->default(null);
            $table->integer('explainheight')->unsigned()->default(null);
            
            $table->foreign('quizid')->references('id')->on('quizzes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
