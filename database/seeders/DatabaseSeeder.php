<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                UserSeeder::class,
                DepartureSeeder::class,
                CalendarEventSeeder::class,
                WindNoteSeeder::class,
                UserProfileSeeder::class,
                QuestionSeeder::class,
                AnswerSeeder::class,
            ]
        );
    }
}
