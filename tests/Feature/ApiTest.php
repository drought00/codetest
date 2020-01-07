<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testListPlayersHasIdFirstNameAndSecondName()
    {
        $response = $this->get('api/players');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'player_id',
                'first_name',
                'second_name'
            ],
        ]);
    }

    public function testGetPlayerCompleteDetails()
    {
        $response = $this->get('api/players/1');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'player_id',
            'first_name',
            'second_name',
            'form',
            'total_points',
            'influence',
            'creativity',
            'threat',
            'ict_index',
            'web_name',
            'in_dreamteam'
        ]);
    }

    public function testInvalidPlayerId()
    {
        $response = $this->get('api/players/invalid_id');
        $response->assertStatus(400);
    }
}
