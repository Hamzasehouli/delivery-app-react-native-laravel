<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /////SIGNUP
    public function signup(Request $request)
    {

        $validatedData = $request->validate([
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
            'password' => Hsah::make($validated['password'], [
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
            'token'=>$token
        ], 201);

    }

    ///////LOGIN
    public function login(Request $request)
    {

    }
}
