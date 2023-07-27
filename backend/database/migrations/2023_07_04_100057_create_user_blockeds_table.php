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
        Schema::create('user_blockeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blocked_user_id');
            $table->foreign('blocked_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->dateTime('date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_blockeds');
    }
};
