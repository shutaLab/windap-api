<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
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
       $users = User::factory(10)->create();

       $users->each(function ($user) {
           UserProfile::factory()->create(['user_id' => $user->id]);
       });

        // 特定のユーザーを作成
        $specificUser = User::create([
            'email' => 'user1@mail.com',
            'password' => Hash::make('password'),
        ]);

        // 特定のユーザーに対してユーザープロファイルを1つ作成
        UserProfile::create([
            'user_id' => $specificUser->id,
            'name' => '山田脩太',
            'sail_no' => '31-50',
            'grade' => 1,
        ]);
    }
}
