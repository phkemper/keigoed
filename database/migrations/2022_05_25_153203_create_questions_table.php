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
            $table->text('questiontext')->default(null);
            $table->mediumText('questionimage')->default(null);
            $table->text('explaintext')->default(null);
            $table->mediumText('explainimage')->default(null);
            
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