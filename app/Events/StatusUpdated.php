<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\Paper;

class StatusUpdated  implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $paperId;
    public $status;

    public function __construct($paperId, $status)
    {
        $this->paperId = $paperId;
        $this->status = $status;
    }

    public function broadcastOn()
    {
        return new Channel('paper-status');
    }

    public function broadcastAs()
    {
        return 'status.updated';
    }

    public function broadcastWith()
    {
        return [
            'paperId' => $this->paperId,
            'status' => $this->status
        ];
    }
}
