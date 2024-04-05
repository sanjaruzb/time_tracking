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
            $table->string("number");
            $table->timestamp("auth_datetime");
            $table->date("auth_date");
            $table->time("auth_time");
            $table->enum("track",[1,-1])->default(1);
            $table->string("turn");
            $table->string("turn_serial");
            $table->string("name");
            $table->string("card_number");
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
