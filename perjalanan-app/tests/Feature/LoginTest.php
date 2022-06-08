<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // migrate database
    use RefreshDatabase;

    // Part 1
    public function test_user_admin_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        User::where('id', $user->id)->update(array(
            'role' => 0,
        ));
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    //Part 2
    public function test_user_passanger_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        User::where('id', $user->id)->update(array(
            'role' => 1,
        ));
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/passenger');
    }

    // Part 3
    public function test_user_driver_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        User::where('id', $user->id)->update(array(
            'role' => 2,
        ));
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/driver');
    }

    // Part 4
    public function test_user_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
