<?php

use App\Events\BatteryStateUpdated;
use App\Jobs\CreateCodeCoverage;
use App\Jobs\UpdateBatteryState;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;

class ApiTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $apiToken = str_random(60);
        $this->user = factory(User::class)->create([
            'api_token' => $apiToken,
        ]);
    }

    /**
     * @test
     */
    public function 用_post_呼叫更新電池狀態的_api_後應建立_UpdateBatteryState_的工作佇列()
    {
        Queue::fake();
        $payload = [
            'percent' => 23,
            'charging' => true,
        ];

        $this->post('/api/battery-state?api_token=' . $this->user->api_token, $payload, ['Accept' => 'application/json'])
            ->assertResponseOk();

        Queue::assertPushed(UpdateBatteryState::class, function ($job) use ($payload) {
            return $job->payload === $payload;
        });
    }

    /**
     * @test
     */
    public function 用_post_呼叫更新電池狀態的_api_後應觸發_BatteryStateUpdated_事件()
    {
        Event::fake();
        $payload = [
            'percent' => 23,
            'charging' => true,
        ];

        $this->post('/api/battery-state?api_token=' . $this->user->api_token, $payload, ['Accept' => 'application/json'])
            ->assertResponseOk();

        Event::assertFired(BatteryStateUpdated::class, function ($event) use ($payload) {
            return $event->payload === $payload;
        });
    }

    /**
     * @test
     */
    public function 用_post_呼叫建立測試涵蓋率的_api_後應建立_CreateCodeCoverage_的工作佇列()
    {
        Queue::fake();
        $payload = [
            'project' => 'Project 1',
            'coverage' => 87.0,
        ];

        $this->post('/api/code-coverage?api_token=' . $this->user->api_token, $payload, ['Accept' => 'application/json'])
            ->assertResponseOk();

        Queue::assertPushed(CreateCodeCoverage::class, function ($job) use ($payload) {
            return $job->payload === $payload;
        });
    }
}
