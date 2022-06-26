<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
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
            'email' => 'testadmin@example.com',
            'password' => 'password',
        ]);
    }

    public function test_admin_screen_can_be_rendered()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_Lihat_list_penumpang()
    {
        $response = $this->get('/list-penumpang');
        $response->assertStatus(200);
    }

    public function test_Lihat_list_pengemudi()
    {
        $response = $this->get('/list-pengemudi');
        $response->assertStatus(200);
    }

    public function test_Lihat_detail_di_list_penumpang()
    {
        $response = $this->get('/list-penumpang/detail/1');
        $response->assertStatus(200);
    }

    public function test_Lihat_detail_di_list_pengemudi()
    {
        $response = $this->get('/list-pengemudi/detail/2');
        $response->assertStatus(200);
    }
}
