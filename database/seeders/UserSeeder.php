<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 特定のメールアドレスとパスワードを持つユーザーを3人分作成
        User::factory()->create([
            'email' => 'user1@mail.com',
            'password' => Hash::make('password')
        ]);

        User::factory()->create([
            'email' => 'user2@mail.com',
            'password' => Hash::make('password')
        ]);

        User::factory()->create([
            'email' => 'user3@mail.com',
            'password' => Hash::make('password')
        ]);
    }
}
