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
        Schema::create('tt', function (Blueprint $table) {
            $table->id();
            $table->string("number")->nullable();
            $table->timestamp("auth_datetime")->nullable();
            $table->date("auth_date")->nullable();
            $table->time("auth_time")->nullable();
            $table->tinyInteger("track")->default(1)->comment("1->вход -1->выход");
            $table->string("turn")->nullable();
            $table->string("turn_serial")->nullable();
            $table->string("name")->nullable();
            $table->string("card_number")->nullable();
            $table->text('info')->nullable();
            $table->unsignedBigInteger('info_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tt');
    }
};
