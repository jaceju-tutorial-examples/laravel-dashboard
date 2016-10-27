<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class CodeCoverageCreated extends DashboardEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    public $payload;

    /**
     * Create a new event instance.
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return $this->payload;
    }
}
