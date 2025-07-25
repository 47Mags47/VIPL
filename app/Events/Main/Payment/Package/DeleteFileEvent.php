<?php

namespace App\Events\Main\Payment\Package;

use App\Models\Main\Payment\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteFileEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public File $file) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('package.' . $this->file->package->id . '.files'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'delete';
    }

    public function broadcastWith(): array
    {
        return [];
    }
}
