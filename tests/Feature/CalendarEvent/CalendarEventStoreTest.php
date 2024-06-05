<?php

namespace Tests\Feature\CalendarEvent;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarEventStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_200(): void
    {
        $response = $this->postJson('api/calendar', [
            'title' => '鎌倉学生選手権',
            'start' => '2024-05-29T09:00:00Z',
            'end' => '2024-05-29T09:00:00Z',
            'is_absent' => false
        ]);

        $response->assertStatus(200);
    }
}
