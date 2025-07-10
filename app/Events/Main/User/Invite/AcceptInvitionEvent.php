<?php

namespace App\Events\Main\User\Invite;

use App\Models\Main\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptInvitionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public User $user)
    {
        $this->user->setStatus('active');
    }
}
