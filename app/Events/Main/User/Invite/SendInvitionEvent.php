<?php

namespace App\Events\Main\User\Invite;

use App\Models\Main\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Mail\SentMessage;
use Illuminate\Queue\SerializesModels;

class SendInvitionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public SentMessage $mail, public User $user)
    {
        $this->user->setStatus('send-invite');
    }
}
