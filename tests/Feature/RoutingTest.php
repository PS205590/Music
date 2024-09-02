<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_you_get_to_songs()
    {
        // Send a GET request to the /songs route
        $response = $this->get('/songs');
    
        // Assert the status code is 200
        $response->assertStatus(200);
    
        // Assert the view being returned is 'songs'
        $response->assertViewIs('songs.index');
    }

    public function test_if_you_get_an_error_when_routing_to_a_nonexisting_routing()
    {
        // Send a GET request to the /songs route
        $response = $this->get('/songs123');
    
        // Assert the status code is 200
        $response->assertStatus(404);
    }
    
}
