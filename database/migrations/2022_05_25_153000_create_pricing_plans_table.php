<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->default('')->unique();
        });
        
        DB::table('pricing_plans')->insert(['id' => 1, 'name' => 'Free']);
        DB::table('pricing_plans')->insert(['id' => 2, 'name' => 'Paid']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricing_plans');
    }
};
