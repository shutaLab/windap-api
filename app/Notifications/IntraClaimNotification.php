<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntraClaimNotification extends Notification
{
    use Queueable;

    protected $intraClaim;

    public function __construct($intraClaim)
    {
        $this->intraClaim = $intraClaim;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'intra_user_id' => $this->intraClaim->intra_user_id,
            'user_id' => $this->intraClaim->user_id
        ];
    }
}
