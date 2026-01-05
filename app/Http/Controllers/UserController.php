<?php

namespace App\Http\Controllers;

use App\Models\User;
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

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Password updated successfully',
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
