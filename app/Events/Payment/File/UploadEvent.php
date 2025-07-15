<?php

namespace App\Events\Payment\File;

use App\Models\Payment\File;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UploadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public File $file)
    {
        //
    }
}
