<?php

namespace App\Events\Payment\Raport;

use App\Models\Main\Raports\Payment\Total;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Total $raport) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('payment.total-raports.' . $this->raport->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'change-status';
    }

    public function broadcastWith(): array
    {
        return [
            'status' => $this->raport->toResource()['status'],
        ];
    }
}
