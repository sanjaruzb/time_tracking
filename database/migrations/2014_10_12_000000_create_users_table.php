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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string("fio")->nullable();
            $table->date("date_entry")->nullable();
            $table->unsignedBigInteger("position_id")->nullable();
            $table->unsignedBigInteger("department_id")->nullable();
            $table->string("education")->nullable();
            $table->string("education_name")->nullable();
            $table->string("graduation_year",10)->nullable();
            $table->string("specialist",100)->nullable();
            $table->date("birthdate")->nullable();
            $table->string("birth_place",100)->nullable();
            $table->tinyInteger("gender")->default(0)->comment("0 -> male, 1 -> female");
            $table->string("nationality")->nullable();
            $table->string("citizenship")->nullable();
            $table->string("family_status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
