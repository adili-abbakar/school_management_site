<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editPassword(User $user)
    {
        return view('users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::transaction(function () use ($validated, $user) {
                $user->update([
                    'password' => Hash::make($validated['password']),
                ]);
            });

            if ($user->type === 'admin') {
                $redirectUrl = 'admins.index';
            } elseif ($user->type === 'teacher') {
                $redirectUrl = 'teachers.index';
            } elseif ($user->type === 'guardian') {
                $redirectUrl = 'guardians.index';
            } elseif ($user->type === 'student') {
                $redirectUrl = 'students.index';
            }

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Password updated successfully',
                    'redirect' => redirect()->route($redirectUrl)
                        ->with('success', 'Password updated successfully!')
                        ->getTargetUrl(),
                ],
                201,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Something went wrong: ' . $th->getMessage(),
                ],
                500,
            );
        }
    }
}
