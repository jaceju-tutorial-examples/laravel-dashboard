<?php

namespace App\Events;

class GoogleCalendarEventsFetched extends DashboardEvent
{
    /**
     * @var array
     */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
