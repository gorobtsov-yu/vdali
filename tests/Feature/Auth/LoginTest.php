<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_auth_user_with_correct_credentials(): void
    {
        $user = User::where('login', 'don_chicho')->first();

        $response = $this->post(route('login'), [
            'login' => $user->login,
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('home');
        
        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_auth_user_with_incorrect_credentials(): void 
    {
        $response = $this->post(route('login'), [
            'login' => 'don_chich',
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('login');

        $this->assertGuest('web');
    }

    public function test_auth_user_without_login(): void 
    {
        $response = $this->post(route('login'), [
            'password' => 'password',
        ]);

        $response->assertInvalid(['login']);
    }

    public function test_auth_user_without_password(): void 
    {
        $response = $this->post(route('login'), [
            'login' => 'don_chicho',
        ]);

        $response->assertInvalid(['password']);
    }
}
