<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /////SIGNUP
    public function signup(Request $request)
    {

        $validated = $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:10'],
        ]);

        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'], [
                'rounds' => 12,
            ]),
            'phone' => $validated['phone'],
        ]);

        $token = $user->createToken('myToken')->plainTextToken;

        return response([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
            'token' => $token,
        ], 201);

    }

    ///////LOGIN
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response(['status' => 'fail', 'message' => 'No user found or password is incorrect'], 404);
            exit;
        }

        $token = $user->createToken('myToken')->plainTextToken;

        return response([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
            'token' => $token,
        ], 200);
    }
}
