<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserProfileStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_200(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, [], 'web');

        $response = $this->postJson('/api/profile', [
            'name' => '山田',
            'grade' => "3",
            'sail_no' => '31-50',
            
        ]);
        dump($response->json());

        $response->assertStatus(200);
    }
}
