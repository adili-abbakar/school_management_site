<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //  Validate input
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // Return field-specific errors
            return response()->json([
                'status' => 'error',
                'type'   => 'validation',
                'errors' => $validator->errors()
            ], 422);
        }

        //  Hard-coded users (prototype)
        $users = [
            [
                'id'       => 1,
                'name'     => "User 1",
                'email'    => 'user1@email.com',
                'username' => 'user_1',
                'password' => '12345678'
            ],
            [
                'id'       => 2,
                'name'     => "User 2",
                'email'    => 'user2@email.com',
                'username' => 'user_2',
                'password' => '12345678'
            ]
        ];

        $matchedUser = collect($users)->first(function ($user) use ($request) {
            return (
                ($user['email'] === $request->email || $user['username'] === $request->email)
                && $user['password'] === $request->password
            );
        });

        if ($matchedUser) {
            Session::put('logged_in', true);
            Session::put('user', $matchedUser);

            return response()->json([
                'status'   => 'success',
                'redirect' => redirect()->intended(route('dashboard'))->getTargetUrl()
            ]);
        }



        //  Global auth error
        return response()->json([
            'status' => 'error',
            'type'   => 'auth',
            'message' => 'Incorrect username/email or password.'
        ], 401);
    }
}
