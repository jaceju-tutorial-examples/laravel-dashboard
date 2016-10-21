<?php

namespace App\Console\Commands;

use App\Events\GoogleCalendarEventsFetched;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class FetchGoogleCalendarEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Calendar events.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = $this->fetchGoogleCalendarEvents();

        event(new GoogleCalendarEventsFetched($events));

        return true;
    }

    /**
     * @return array
     */
    private function fetchGoogleCalendarEvents():array
    {
        return Event::get()
            ->map(function (Event $event) {
                return [
                    'name' => $event->name,
                    'date' => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())
                        ->format(DateTime::ATOM),
                ];
            })
            ->unique('name')
            ->toArray();
    }
}
