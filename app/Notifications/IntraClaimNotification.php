<?php

namespace App\Notifications;

use App\Http\Resources\DepartureResource;
use App\Http\Resources\IntraClaimResource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
        return ['database', 'mail'];
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

    public function toMail($notifiable)
    {
        $this->departure->load('user.userProfile', 'intraUser.userProfile');

        $subject = match ($this->type) {
            'approved' => '申請が承認されました',
            'rejected' => '申請が却下されました',
            'commented' => '新しいコメントがあります',
            default => 'イントラ申請通知'
        };
        $detailUrl = config('FRONT_URL') . 'myPage/intra';
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($subject)
            ->greeting('こんにちは')
            ->line("イントラ申請について通知です。")
            ->when($this->comment, function ($message) {
                return $message->line("コメント: {$this->comment}");
            })
            ->line("申請者: {$this->departure->user->userProfile->name}")
            ->line("出艇時間: {$this->departure->start->format('m月d日 H:i~')}{$this->departure->end->format('H:i')}")
            ->action('詳細を確認', $detailUrl)
            ->line('このメールはシステムより自動送信されています。');
    }
}
