<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Auth\PasswordResetToken;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function index(Request $request)
    {
        if (
            !$request->filled('token') ||
            !$request->filled('email')
        ) {
            abort(404);
        }
        return view('auth.reset-password', ['token' => $request->token, 'email' => $request->email]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'type' => 'validation',
                'errors' => $validator->errors(),
            ]);
        }

        $validated = $validator->validated();

        $passwordReset = PasswordResetToken::where(
            'email',
            $validated['email']
        )->first();

        if (!$passwordReset) {
            return response()->json([
                'status' => 'error',
                'type' => 'auth',
                'message' => 'This password reset link is invalid or has expired.',
            ]);
        }

        if (!Hash::check($validated['token'], $passwordReset->token)) {
            $passwordReset->delete();

            return response()->json([
                'status' => 'error',
                'type' => 'auth',
                'message' => 'This password reset link is invalid or has expired.',
            ]);
        }

        if ($passwordReset->created_at->addMinutes(60)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'status' => 'error',
                'type' => 'auth',
                'message' => 'This password reset link has expired.',
            ]);
        }

        $user = User::firstWhere('email', $validated['email']);
        
        if (!$user) {
            $passwordReset->delete();

            return response()->json([
                'status' => 'error',
                'type' => 'auth',
                'message' => 'Unable to reset your password.',
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $passwordReset->delete();

        session()->flash(
            'success',
            'Your password has been reset successfully. You can now log in.'
        );

        return response()->json([
            'status' => 'success',
            'redirect' => route('login'),
        ]);
    }
}
