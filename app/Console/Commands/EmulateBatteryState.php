<?php

namespace App\Console\Commands;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class EmulateBatteryState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emulate:battery-state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emulate battery state updated';

    /**
     * @var int
     */
    private $percent = 100;

    /**
     * @var bool
     */
    private $charging = false;

    /**
     * Execute the console command.
     *
     * @param User $userModel
     * @return mixed
     */
    public function handle(User $userModel)
    {
        $this->updateState();
        $this->sendRequest($userModel);
    }

    private function updateState()
    {
        if ($this->charging) {
            $this->percent = $this->percent + mt_rand(5, 10);
            if ($this->percent >= 100) {
                $this->percent = 100;
                $this->charging = false;
                $this->info('Battery is fully charged.');
            } else {
                $this->info(sprintf('Charging to %d%%.', $this->percent));
            }
        } else {
            $this->percent = $this->percent - mt_rand(5, 10);
            if ($this->percent <= 0) {
                $this->percent = 0;
                $this->charging = true;
                $this->info('Battery is charging.');
            } else {
                $this->info(sprintf('Battery percentage is %d%%.', $this->percent));
            }
        }
    }

    private function sendRequest(User $userModel)
    {
        $apiToken = $userModel->find(1)->api_token;
        $client = new Client([
            'base_uri' => 'http://example-dashboard.dev',
        ]);

        $client->post('/api/battery-state', [
            'query' => [
                'api_token' => $apiToken,
            ],
            'form_params' => [
                'percent' => $this->percent,
                'charging' => $this->charging,
            ],
        ]);
    }
}
