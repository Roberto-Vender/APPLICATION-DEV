<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'displayName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'display_name' => $validated['displayName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'total_points' => 1000,
            'riddle_points' => 0,
            'logic_points' => 0,
            'endurance_points' => 0,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'user_id' => $user->id,
                'display_name' => $user->display_name,
                'email' => $user->email,
                'total_points' => $user->total_points,
                'riddle_points' => $user->riddle_points,
                'logic_points' => $user->logic_points,
                'endurance_points' => $user->endurance_points,
            ],
            'token' => $token
        ]);
    }
}
