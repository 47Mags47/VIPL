<?php

namespace App\Events\Main\Payment\Package;

use App\Models\Main\Payment\Package;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateFileListEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Package $package) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('package.' . $this->package->id . '.files'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'update-list';
    }

    public function broadcastWith(): array
    {
        return [];
    }
}
