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

                $relation = match ($user->type) {
                    'admin'   => $user->admin,
                    'teacher' => $user->teacher,
                    'guardian' => $user->guardian,
                    'student' => $user->student,
                    default   => null,
                };

                if ($relation) {
                    $relation->touch();
                }
            });

            $redirectUrl = match ($user->type) {
                'admin' => 'admins.index',
                'teacher' => 'teachers.index',
                'guardian' => 'guardians.index',
                'student' => 'students.index',
            };

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
