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
        Schema::create('departures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('ユーザID');
            $table->foreignId('intra_user_id')->nullable()->constrained('users')->onDelete('cascade')->comment('イントラ相手のID');
            $table->dateTime('start')->comment('出艇開始時間');
            $table->dateTime('end')->comment('出艇終了時間');
            $table->string('description')->nullable()->comment('備考');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departures');
    }
};
