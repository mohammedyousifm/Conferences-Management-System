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

class ReviewerComment implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $Reviewer_Name;
    public $Paper_Code;
    public function __construct($Reviewer_Name, $Paper_Code)
    {
        $this->Reviewer_Name = $Reviewer_Name;
        $this->Paper_Code = $Paper_Code;
    }

    public function broadcastOn()
    {
        return new Channel('reviewer-comment');
    }


    public function broadcastAs()
    {
        return 'comment-reviewer';
    }

    public function broadcastWith()
    {
        return [
            'Reviewer_Name' => $this->Reviewer_Name,
            'Paper_Code' => $this->Paper_Code,
        ];
    }
}
