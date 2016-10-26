<?php

use App\Console\Commands\FetchGoogleCalendarEvents;
use App\Events\GoogleCalendarEventsFetched;
use AspectMock\Test;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Spatie\GoogleCalendar\Event as GoogleCalendarEvent;

class CommandTest extends TestCase
{
    public function tearDown()
    {
        Test::clean();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function 執行_FetchGoogleCalendarEvents_命令後該觸發_GoogleCalendarEventsFetched_事件()
    {
        // Arrange
        Event::fake();

        $expectedEvents = [
            'name' => 'example',
            'date' => '2016-10-29T00:00:00+00:00',
        ];

        Test::double(GoogleCalendarEvent::class, [
            'getSortDate' => '2016-10-29 00:00:00',
        ]);
        $event = new GoogleCalendarEvent();
        $event->name = 'example';

        Test::double(GoogleCalendarEvent::class, [
            'get' => collect([
                $event
            ]),
        ]);

        // Act
        Artisan::call('dashboard:calendar');

        // Assert
        Event::assertFired(GoogleCalendarEventsFetched::class, function ($payload) use ($expectedEvents) {
            return $payload->events[0] === $expectedEvents;
        });
    }

}
