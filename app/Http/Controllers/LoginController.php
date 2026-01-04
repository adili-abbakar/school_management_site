<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'type' => 'validation',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        // Find user by email OR admin staff_number
        $user = User::where('email', $request->email)
            ->orWhereHas('admin', function ($query) use ($request) {
                $query->where('staff_number', $request->email);
            })
            ->first();

        // Check password
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Record last login time
            $user->update(['last_login_at' => now()]);

            return response()->json([
                'status' => 'success',
                'redirect' => redirect()->intended(route('dashboard'))->getTargetUrl(),
            ]);
        }

        // Global auth error
        return response()->json(
            [
                'status' => 'error',
                'type' => 'auth',
                'message' => 'Incorrect email/staff number or password.',
            ],
            401,
        );
    }

    public function logout(Request $request)
    {
        // If you’re using Laravel’s Auth
        Auth::logout();

        // Clear all session data
        Session::flush();

        // Regenerate session ID for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect straight to login page
        return redirect()->route('home');
    }
}
