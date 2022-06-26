<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PassangerTest extends TestCase
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
            'email' => 'testpassenger@example.com',
            'password' => 'password',
        ]);
    }

    public function akses_dashboard_driver()
    {
        $response = $this->get('/passenger');
        $response->assertStatus(200);
    }

    public function akses_pemesanan_passenger()
    {
        $response = $this->get('/passenger/pemesanan');
        $response->assertStatus(200);
    }

    public function akses_perjalanan_passenger()
    {
        $response = $this->get('/passenger/perjalanan');
        $response->assertStatus(200);
    }

    public function akses_riwayat_passenger()
    {
        $response = $this->get('/passenger/history');
        $response->assertStatus(200);
    }
}
