<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Database\Seeders\ArtSpaceSeeder;
use Database\Seeders\KidSeeder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed([ArtSpaceSeeder::class, KidSeeder::class]);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
