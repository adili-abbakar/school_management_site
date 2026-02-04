<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Teacher;
use App\Models\Users\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('users.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'local_government' => 'required|string|max:100',
            'religion' => 'required|string|max:100',
            'tribe' => 'required|string|max:100',
            'address' => 'required|string|max:255',

            'staff_number' => 'required|string|max:50|unique:admins,staff_number',
            'specialized_subject' => 'nullable|string|max:255',
            'highest_qualification' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'employment_type' => 'required|in:full_time,part_time,contract',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'middle_name' => $validated['middle_name'],
                    'last_name' => $validated['last_name'] ?? null,
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['staff_number']),
                    'phone' => $validated['phone'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'nationality' => $validated['nationality'],
                    'state' => $validated['state'],
                    'local_government' => $validated['local_government'],
                    'religion' => $validated['religion'],
                    'tribe' => $validated['tribe'],
                    'address' => $validated['address'],
                    'type' => 'teacher',
                ]);

                Teacher::create([
                    'user_id' => $user->id,
                    'staff_number' => $validated['staff_number'],
                    'specialized_subject' => $validated['specialized_subject'],
                    'highest_qualification' => $validated['highest_qualification'] ?? null,
                    'years_of_experience' => $validated['years_of_experience'] ?? 0,
                    'start_date' => $validated['start_date'] ?? now()->toDateString(),
                    'employment_type' => $validated['employment_type'],
                ]);
            });

            return redirect()->back()
                ->with('success', 'Teacher created successfully!')
                ->getTargetUrl();
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'Error',
                    'message' => 'Something went wrong: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('user');
        return view('users.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('users.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'local_government' => 'required|string|max:100',
            'religion' => 'required|string|max:100',
            'tribe' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'specialized_subject' => 'nullable|string|max:255',
            'staff_number' => 'required|string|max:50|unique:admins,staff_number,' . $teacher->user_id . ',user_id',

            'highest_qualification' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'employment_type' => 'required|in:full_time,part_time,contract',
        ]);

        try {
            DB::transaction(function () use ($validated, $teacher) {
                $teacher->user->update([
                    'first_name' => $validated['first_name'],
                    'middle_name' => $validated['middle_name'] ?? null,
                    'last_name' => $validated['last_name'] ?? null,
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'nationality' => $validated['nationality'],
                    'state' => $validated['state'],
                    'local_government' => $validated['local_government'],
                    'religion' => $validated['religion'],
                    'tribe' => $validated['tribe'],
                    'address' => $validated['address'],
                ]);

                $teacher->update([
                    'staff_number' => $validated['staff_number'],
                    'specialized_subject' => $validated['specialized_subject'],
                    'highest_qualification' => $validated['highest_qualification'] ?? null,
                    'years_of_experience' => $validated['years_of_experience'] ?? 0,
                    'start_date' => $validated['start_date'] ?? null,
                    'employment_type' => $validated['employment_type'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Teacher Updated successfully',
                'redirect' => redirect()
                    ->intended(route('teachers.index'))
                    ->with('success', 'Teacher Updated successfully!')
                    ->getTargetUrl(),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Teacher $teacher)
    {
        try {
            DB::transaction(function () use ($teacher) {
                $teacher->user->delete();
                $teacher->delete();

            });

            return response()->json([
                'status' => 'success',
                'message' => 'Teacher Deleted successfully',
                'redirect' => redirect()
                    ->intended(route('teachers.index'))
                    ->with('success', 'Teacher Deleted successfully!')
                    ->getTargetUrl(),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Teacher $teacher)
    {
        $user = $teacher->load('user');
        $route = route('teachers.destroy', $teacher->user_id);
        $userType = 'Teacher';

        $messages = [
            "This account will be deactivated. Their records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('users.soft-delete', compact('user', 'route', 'messages'));
    }
}
