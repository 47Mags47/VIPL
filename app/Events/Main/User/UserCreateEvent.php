<?php

namespace App\Events\Main\User;

use App\Jobs\Main\User\SendInvitionJob;
use App\Models\Main\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public User $user) {
        SendInvitionJob::dispatch($user);
    }
}
