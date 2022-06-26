<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    // migrate database
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');

        // login
        $this->post('/login', [
            'email' => 'testdriver@example.com',
            'password' => 'password',
        ]);
    }

    public function akses_dashboard_driver()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    public function akses_perjalanan_driver()
    {
        $response = $this->get('/driver/perjalanan');
        $response->assertStatus(200);
    }

    public function akses_riwayat_driver()
    {
        $response = $this->get('/driver/history');
        $response->assertStatus(200);
    }
}
