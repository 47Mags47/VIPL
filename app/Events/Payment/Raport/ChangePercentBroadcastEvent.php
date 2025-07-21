<?php

namespace App\Events\Payment\Raport;

use App\Models\Main\Raports\Payment\Total;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangePercentBroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Total $raport,
        public int|float $percent
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('raports.' . $this->raport->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'update';
    }

    public function broadcastWith(): array
    {
        return [
            'percent' => $this->percent,
            'status' => $this->raport->status->type,
        ];
    }
}
