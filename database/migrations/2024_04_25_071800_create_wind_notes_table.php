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
        Schema::create('wind_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('タイトル');
            $table->text('content')->comment('ノート内容');
            $table->dateTime('date')->nullable(true)->comment('日付');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wind_notes');
    }
};
