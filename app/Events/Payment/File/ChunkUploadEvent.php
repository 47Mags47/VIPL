<?php

namespace App\Events\Payment\File;

use App\Models\Main\Payment\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChunkUploadEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $percent;

    public function __construct(public File $file, public int $currentRow, public int $totalRow)
    {
        $this->percent = (int) ($currentRow * 100) / $totalRow;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('files.' . $this->file->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'change-percent';
    }

    public function broadcastWith(): array
    {
        return [
            'percent' => $this->percent,
        ];
    }
}
