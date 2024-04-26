<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->time('day1_1')->default('08:00:00');
            $table->time('day1_2')->default('17:00:00');
            $table->time('day2_1')->default('08:00:00');
            $table->time('day2_2')->default('17:00:00');
            $table->time('day3_1')->default('08:00:00');
            $table->time('day3_2')->default('17:00:00');
            $table->time('day4_1')->default('08:00:00');
            $table->time('day4_2')->default('17:00:00');
            $table->time('day5_1')->default('08:00:00');
            $table->time('day5_2')->default('17:00:00');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
