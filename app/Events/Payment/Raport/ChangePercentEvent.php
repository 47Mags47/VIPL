<?php

namespace App\Events\Payment\Raport;

use App\Models\Main\Raports\Payment\Total;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangePercentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Total $raport,
        public int|float $percent
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('payment.total-raports.' . $this->raport->id),
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
