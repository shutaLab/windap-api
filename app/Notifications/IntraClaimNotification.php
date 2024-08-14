<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntraClaimNotification extends Notification
{
    use Queueable;

    protected $intraClaim, $comment;

    public function __construct($intraClaim,$comment = null)
    {
        $this->intraClaim = $intraClaim;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'intra_user' => User::find($this->intraClaim->intra_user_id),
            'departure_user' => User::find($this->intraClaim->user_id),
            'comment' => $this->comment
        ];
    }
}
