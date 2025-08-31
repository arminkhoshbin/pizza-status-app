<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PizzaStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public int $userId, public string $status)
    {
    }

    public function broadcastWith()
    {
        return ['status' => $this->status];
    }

    public function broadcastAs()
    {
        return 'pizza-status.updated';
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('pizza-status.' . $this->userId),
        ];
    }
}
