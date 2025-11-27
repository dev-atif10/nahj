<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\ApiResponse;

class UserAuthController extends Controller
{ 
    // Include the trait
    use ApiResponse;

    /// Register new user
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Check if user already exists
        $existingUser = User::where('email', $fields['email'])->first();
        if ($existingUser) {
            return $this->error('Email already exists', 409);
        }

        // Create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            ['user' => $user, 'token' => $token],
            'User registered successfully',
            201
        );
    }

    /// Login user
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]); 

        $user = User::where('email', $fields['email'])->first();
 
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->error('Invalid credentials', 401);
        }
        $user->tokens()
     ->where('created_at', '<=', now()->subMinutes(config('sanctum.expiration')))
     ->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success( 
            ['user' => $user, 'token' => $token],
            'Logged in successfully'
        );
    }

    /// Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'Logged out successfully');
    }

    /// Get authenticated user
    public function me(Request $request)
    {
        return $this->success(['user' => $request->user()], 'User retrieved successfully');
    }
}
