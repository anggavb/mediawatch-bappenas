<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
// use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            // 'token' => $user->createToken('auth')->plainTextToken,
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
            'user' => $user
        ]);
    }

    // public function googleRedirect()
    // {
    //     return Socialite::driver('google')->stateless()->redirect();
    // }

    // public function googleCallback()
    // {
    //     $googleUser = Socialite::driver('google')->stateless()->user();

    //     $user = User::updateOrCreate([
    //         'provider' => 'google',
    //         'provider_id' => $googleUser->getId(),
    //     ], [
    //         'email' => $googleUser->getEmail(),
    //         'name' => $googleUser->getName(),
    //     ]);

    //     return response()->json([
    //         'token' => $user->createToken('auth')->plainTextToken,
    //         'user' => $user
    //     ]);
    // }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
