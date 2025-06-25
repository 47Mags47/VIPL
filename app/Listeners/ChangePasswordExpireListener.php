<?php

namespace App\Listeners;

use App\Models\Glossary\UserStatus;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangePasswordExpireListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        $event->user->update(['password_expired' => false]);
        $event->user->setStatus(UserStatus::byCode('active'));
    }
}
