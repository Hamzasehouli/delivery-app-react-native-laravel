<?php

namespace App\Http\Controllers;

use App\Mail\sendResetPasswordLinkEmail;
use App\Mail\welcomeemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /////SIGNUP
    public function signup(Request $request)
    {

        $validated = $request->validate([
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users'],
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

        Mail::to($user->email)->send(new welcomeemail($user->firstname));

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

    ///////LOG OUT

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response([
            'status' => 'success',
            'message' => 'You have logged out successfully',
        ], 200);
    }
    ////////////
    //////////Forgetpassword

    public function forgetpassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response(['status' => 'fail', 'message' => 'No user found or password is incorrect'], 404);
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $user->resettoken = $token;
        $user->resettokencreatedat = time();
        $user->save();

        $link = "http://localhost:8000/api/auth/resetpassword/$token";

        Mail::to($user->email)->send(new sendResetPasswordLinkEmail($link));

        return response([
            'status' => 'success',
            'message' => 'Email sent successfully successfully',
        ], 200);

    }

    ////Reset password

    public function resetpassword($token, Request $request)
    {

        $user = User::where('resettoken', $token)->first();

        if (!$user) {
            return response(['status' => 'fail', 'message' => 'No user found or password is incorrect'], 404);
            exit;
        }

        if (($user->resettokencreatedat + 10 * 60) < time()) {
            $user->resettoken = '';
            $user->resettokencreatedat = '';
            $user->save();
            return response(['status' => 'fail', 'message' => 'Link has expired, please try again'], 400);
        }

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'string', 'min:8'],
        ]);

        if($validated['password'] !== $validated['confirmPassword']){
            return response(['status' => 'fail', 'message' => 'Please confirm your password'], 400);
        }

        $user->update(['password' => Hash::make($validated['password']), 'resettoken' => '', 'resettokencreatedat' => '']);
        return response([
            'status' => 'success',
            'message' => 'Password has been reset successfully',
        ], 200);

    }

    //////GET MY DATA

    public function deleteme()
    {

        $user = Auth::user();
        $user->delete();
        return response([
            'status' => 'success',
            'message' => 'User delete successfully',
        ], 204);
    }

    /////////////Delete me

    public function getmydata()
    {

        $user = Auth::user();
        return response([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
        ], 200);
    }

    //////Update MY DATA

    public function updatemydata(Request $request)
    {
        if ($request->password) {
            return response([
                'status' => 'fail',
                'message' => 'If you want to update the password, please use the appropriate route',
            ], 403);
        }
        $user = Auth::user();
        $user->update($request->all());
        return response([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
        ], 200);
    }

}
