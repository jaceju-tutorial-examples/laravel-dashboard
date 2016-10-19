<?php

namespace App\Jobs;

use App\Events\BatteryStateUpdated;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateBatteryState implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    public $payload;

    /**
     * Create a new job instance.
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(app(BatteryStateUpdated::class, [$this->payload]));
    }
}
