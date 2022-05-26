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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->default('Name')->index();
            $table->text('introtext')->nullable()->default(null);
            $table->mediumText('introimage')->default(null);
            $table->text('outrotext')->nullable()->default(null);
            $table->mediumText('outroimage')->default(null);
            $table->integer('pin')->unsigned()->unique();
            $table->bigInteger('pricingplanid')->unsigned()->default(null);
            
            $table->foreign('pricingplanid')->references('id')->on('pricing_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
