<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewPaper implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $paper_code;

    public function __construct($paper_code)
    {
        $this->paper_code = $paper_code;
    }

    public function broadcastOn()
    {
        return new Channel('new-paper');
    }

    public function broadcastAs()
    {
        return 'paper-new';
    }

    public function broadcastWith()
    {
        return [
            'paper_code' => $this->paper_code,
        ];
    }
}
