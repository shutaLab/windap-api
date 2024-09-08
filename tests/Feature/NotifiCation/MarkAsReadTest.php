<?php

namespace Tests\Feature\Notification;

use App\Models\Departure;
use App\Models\User;
use App\Notifications\IntraClaimNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MarkAsReadTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_200(): void
    {
        $user = User::first();

        $departure = Departure::factory()->create(['user_id' => $user->id]);

         // テスト用の通知を作成
         $notification = new IntraClaimNotification('test_intraClaim', 'test_comment', $departure);
         $user->notify($notification);

         $notificationId = $user->unreadNotifications->first()->id;
        $response = $this->post("/notifications/{$notificationId}/read");


        $response->assertStatus(200);
    }
}
