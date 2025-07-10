<?php

namespace App\Jobs\Main\User;

use App\Events\Main\User\Invite\SendInvitionEvent;
use App\Mail\InviteMail;
use App\Models\Main\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInvitionJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = Mail::to($this->user->email)->send(new InviteMail($this->user));

        SendInvitionEvent::dispatch($mail, $this->user);
    }
}
