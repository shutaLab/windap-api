<?php

namespace Tests\Feature\CalendarEvent;

use App\Models\CalendarEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarEventIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_200(): void
    {
        $calendarEvent = CalendarEvent::factory()->count(10)->create();

        $reponse = $this->getJson("/api/calendar/");

        $reponse->assertStatus(200);
    }
}
