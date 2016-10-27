<?php

namespace App\Console\Commands;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class EmulateCodeCoverage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emulate:code-coverage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emulate code coverage created';

    /**
     * @var string
     */
    private $project = 'Project';

    /**
     * @var float
     */
    private $coverage = 0.0;

    /**
     * Execute the console command.
     *
     * @param User $userModel
     * @return mixed
     */
    public function handle(User $userModel)
    {
        $this->createCodeCoverage();
        $this->sendRequest($userModel);
    }

    private function createCodeCoverage()
    {
        $this->project = 'Project ' . mt_rand(1, 3);
        $this->coverage = mt_rand(40, 100);
        $this->info(sprintf('Code coverage of "%s" percentage is %.2f%%.', $this->project, $this->coverage));
    }

    private function sendRequest(User $userModel)
    {
        $apiToken = $userModel->find(1)->api_token;
        $client = new Client([
            'base_uri' => 'http://example-dashboard.dev',
        ]);

        $client->post('/api/code-coverage', [
            'query' => [
                'api_token' => $apiToken,
            ],
            'form_params' => [
                'project' => $this->project,
                'coverage' => $this->coverage,
            ],
        ]);
    }
}
