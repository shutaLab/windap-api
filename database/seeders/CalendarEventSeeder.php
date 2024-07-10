<?php

namespace Database\Seeders;

use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        for ($i = 0; $i < 5; ++$i) {
            $authUser = $users->random();

            CalendarEvent::factory()->create([
                'user_id' => $authUser->id,
            ]);
        }
    }
}
