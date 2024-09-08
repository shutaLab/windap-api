<?php

namespace App\Notifications;

use App\Http\Resources\DepartureResource;
use App\Http\Resources\IntraClaimResource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntraClaimNotification extends Notification
{
    use Queueable;

    protected $intraClaim;
    protected $comment;
    protected $departure;
    protected $type;

    public function __construct($intraClaim, $comment, $departure, $type = null)
    {
        $this->intraClaim = $intraClaim;
        $this->comment = $comment;
        $this->departure = $departure;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $this->departure->load('user.userProfile', 'intraUser.userProfile');
        return [
            'intraClaim' => new IntraClaimResource($this->intraClaim),
            'comment' => $this->comment,
            'departure' => new DepartureResource($this->departure),
            'type' => $this->type
        ];
    }
}
