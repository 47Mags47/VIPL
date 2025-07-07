<?php

namespace App\Listeners\Payment\File;

use App\Events\Payment\File\UploadEvent;
use App\Jobs\Payment\Files\ReadToDB;

class ReadListener
{
    /**
     * Handle the event.
     */
    public function handle(UploadEvent $event): void
    {
        ReadToDB::dispatch($event->file);
    }
}
