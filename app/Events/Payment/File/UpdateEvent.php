<?php

namespace App\Events\Payment\File;

use App\Models\Main\Payment\File;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public File $file) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('files.' . $this->file->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'update';
    }

    public function broadcastWith(): array
    {
        return [
            'file' => $this->file->toResource(),
        ];
    }
}
