<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Auth\PasswordResetToken;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
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
        $email = $validator->validated()['email'];

        $user = User::firstWhere('email', $email);
        if ($user) {
            PasswordResetToken::where('email', $email)->delete();

            $token = Str::random(64);
            PasswordResetToken::create([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]);

            try {
                Mail::to($user->email)
                    ->send(new ResetPasswordMail($user, $token));
            } catch (\Throwable $e) {

                PasswordResetToken::where('email', $user->email)
                    ->delete();

                report($e);

                return response()->json([
                    'status' => 'error',
                    'type' => 'mail',
                    'error' => $e->getMessage(),
                    'message' => 'Unable to send the password reset email. Please try again later.',
                ]);
            }
        }

        // return back()->with('If an account with that email exists, a password reset link has been sent.');

        session()->flash(
            'success',
            'If an account with that email exists, a password reset link has been sent.'
        );

        return response()->json([
            'status' => 'success',
            'redirect' => url()->previous(),
        ]);
    }
}
