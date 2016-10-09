<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
}
