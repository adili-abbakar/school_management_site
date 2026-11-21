<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editPassword(User $user, Request $request)
    {
        $user_type = $request->get('user_type');
        return view('users.edit-password', compact('user', 'user_type'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user_type = $request->input('user_type');
        try {
            DB::transaction(function () use ($validated, $user, $user_type) {
                $user->update([
                    'password' => Hash::make($validated['password']),
                ]);

                $relation = match ($user_type) {
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

            $redirectUrl = match ($user_type) {
                'admin' => 'admins.index',
                'teacher' => 'teachers.index',
                'guardian' => 'guardians.index',
                'student' => 'students.index',
                default   => null,
            };

            if (!$redirectUrl) {
                $redirectUrl =  'dashboard.index';
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
