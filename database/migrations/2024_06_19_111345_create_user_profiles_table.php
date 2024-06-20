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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->comment('ユーザ名');
            $table->string('grade')->comment('学年');
            $table->string('sail_no')->comment('セールナンバー');
            $table->string('introduction')->comment('自己紹介文');
            $table->string('profile_image')->nullable(true)->comment('プロフィール画像');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
