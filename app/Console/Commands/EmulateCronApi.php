<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class EmulateCronApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emulate:cron-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emulate cron jobs and api';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        while (true) {
            Artisan::call('emulate:battery-state');
            Artisan::call('emulate:code-coverage');
            sleep(3);
        }
        return null;
    }
}
