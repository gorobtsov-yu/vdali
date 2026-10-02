<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_unauthorized_user_cant_logout(): void
    {
        $this->assertGuest();

        $response = $this->get(route('logout'));

        $this->assertGuest();
    }

    public function test_authorized_user_can_logout(): void
    {
        $user = User::where('login', 'don_chicho')->first();
        Auth::login($user);

        $this->assertAuthenticated('web');

        $response = $this->get(route('logout'));

        $this->assertGuest();
    }
}
