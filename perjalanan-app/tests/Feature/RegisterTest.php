<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    // migrate database
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_passanger_can_register()
    {
        $this->post('/register', [
            'name' => 'Testing Passanger',
            'email' => 'testingPassanger@example.com',
            'password' => 'password',
            'terms' => 1,
        ]);

        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_new_Driver_can_register()
    {
        $this->post('/register', [
            'name' => 'Testing Driver',
            'email' => 'testingDriver@example.com',
            'password' => 'password',
            'vehicle_type' => 'Mobil',
            'model' => 'Model Mobil Test',
            'plat' => 'BG 1234 KT',
            'terms' => 1
        ]);

        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
