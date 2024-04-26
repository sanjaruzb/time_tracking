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
        Schema::create('change_hours', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('description');
            $table->string('shift');
            $table->tinyInteger('status')->default(0)->comment('0 - yangi, 1 - tasdiqlangan, 2 - rad etilgan');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();
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
