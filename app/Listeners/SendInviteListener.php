<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\InviteMail;
use App\Models\Main\User;
use Illuminate\Support\Facades\Mail;

class SendInviteListener
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(User $user): void
    {
        Mail::to($user->email)->send(new InviteMail($user));
        $user->setStatus('send-invite');
    }
}
