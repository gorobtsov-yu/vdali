<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $c = $request->validated();

        $user = User::create($c);

        Auth::login($user);

        return response()->json([
            'id' => $user->id,
            'login' => $user->login,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $c = $request->validated();

        if (Auth::attempt($c, true)) {
            $user = Auth::user();

            return response()->json([
                'id' => $user->id,
                'login' => $user->login,
            ]);
        }

        $validator = Validator::make($request->all(), [])->errors()->add('login', 'aaaaaaaaaa');

        return response()->json([
            'message' => 'Invalid credentials.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Successful logout.',
        ]);
    }
}
