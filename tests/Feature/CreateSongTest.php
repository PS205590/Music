<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSongTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_song_requires_authentication()
    {
        // Define the data for the new song
        $data = [
            'title' => 'Test Title',
            'singer' => 'Test Singer',
        ];
    
        // Send a POST request without authentication
        $response = $this->post('/songs', $data);
    
        // Assert the response status is 302 (redirect) or 403 (forbidden)
        $response->assertStatus(302); // Or 403 depending on your setup
    
        // Optionally, assert redirection to the login page
        $response->assertRedirect('/login');
    }
    
}
