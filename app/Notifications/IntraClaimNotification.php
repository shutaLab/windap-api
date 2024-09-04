<?php

namespace App\Notifications;

use App\Http\Resources\IntraClaimResource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntraClaimNotification extends Notification
{
    use Queueable;

    protected $intraClaim;
    protected $comment;
    protected $type;

    public function __construct($intraClaim, $comment, $type = null)
    {
        $this->intraClaim = $intraClaim;
        $this->comment = $comment;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $this->intraClaim->load('departure', 'user.userProfile');
        return [
            'intraClaim' => new IntraClaimResource($this->intraClaim),
            'comment' => $this->comment,
            'type' => $this->type
        ];
    }
}
