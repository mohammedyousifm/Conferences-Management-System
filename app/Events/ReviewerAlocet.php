<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class ReviewerAlocet implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $controller_name;
    public $reviewer_name;
    public $paper_code;

    public function __construct($controller_name, $reviewer_name, $paper_code)
    {
        $this->controller_name = $controller_name;
        $this->reviewer_name = $reviewer_name;
        $this->paper_code = $paper_code;
    }

    // Define the channel to broadcast on
    public function broadcastOn()
    {
        return new Channel('my-channel');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return [
            'controller_name' => $this->controller_name,
            'reviewer_name' => $this->reviewer_name,
            'paper_code' => $this->paper_code,
        ];
    }
}
