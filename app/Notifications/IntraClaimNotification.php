<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntraClaimNotification extends Notification
{
    use Queueable;

    protected $intraClaim;
    protected $comment;

    public function __construct($intraClaim, $comment = null)
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
            'intraClaim' => $this->intraClaim,
            'comment' => $this->comment
        ];
    }
}
