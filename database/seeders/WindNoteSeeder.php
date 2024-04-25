<?php

namespace Database\Seeders;

use App\Models\WindNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WindNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WindNote::factory()->count(10)->create();
    }
}
