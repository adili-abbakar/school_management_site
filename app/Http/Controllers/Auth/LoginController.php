<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
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
                200,
            );
        }

        $user = User::where('email', $request->email)
            ->orWhereHas('staff', function ($query) use ($request) {
                $query->where('staff_number', $request->email);
            })
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            $user->update(['last_login_at' => now()]);

            return response()->json([
                'status' => 'success',
                'redirect' => redirect()
                    ->intended(route('dashboard.index'))
                    ->with('success', 'Logged In Successfully')
                    ->getTargetUrl(),
            ]);
        }

        return response()->json(
            [
                'status' => 'error',
                'type' => 'auth',
                'message' => 'Incorrect email/staff number or password.',
            ],
            200,
        );
    }

    public function logout(Request $request)
    {

        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logged out successfully!');
    }
}
