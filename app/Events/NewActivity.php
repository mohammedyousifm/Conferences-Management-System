<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class NewActivity implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public string $user;
    public string $message;

    public function __construct(string $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    // Define the channel to broadcast on
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

    // Define the event name (optional)
    public function broadcastAs()
    {
        return 'my-event';
    }

    // Make sure the event sends all data
    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'message' => $this->message,
        ];
    }
}
