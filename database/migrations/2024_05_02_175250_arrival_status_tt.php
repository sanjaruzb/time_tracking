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
        Schema::table('tt', function (Blueprint $table){
            $table->tinyInteger('arrival_status')->default(1)->comment('1 - kemagan, 2 - vaqtida kegan, 3 - kechikib kegan, -1 - ketmagan, -2 - vaqtida ketgan, -3 - erta ketgan');
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
