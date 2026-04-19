<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));

        $admins = Admin::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('staff_number', 'like', "%{$search}%")
                        ->orWhere('role_type', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.admins.partials.rows', compact('admins'))->render(),
                'pagination' => view('users.admins.partials.pagination', compact('admins'))->render()
            ]);
        }

        return view('users.admins.index', ['admins' => $admins]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate all user + admin fields
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
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
            'role_type' => 'required|in:super_admin,exam_officer,admission_officer',
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
                    'password' => Hash::make($validated['password']),
                    'phone' => $validated['phone'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'nationality' => $validated['nationality'],
                    'state' => $validated['state'],
                    'local_government' => $validated['local_government'],
                    'religion' => $validated['religion'],
                    'tribe' => $validated['tribe'],
                    'address' => $validated['address'],
                    'type' => 'admin',
                ]);

                Admin::create([
                    'user_id' => $user->id,
                    'staff_number' => $validated['staff_number'],
                    'role_type' => $validated['role_type'],
                    'highest_qualification' => $validated['highest_qualification'] ?? null,
                    'years_of_experience' => $validated['years_of_experience'] ?? 0,
                    'start_date' => $validated['start_date'] ?? now()->toDateString(),
                    'employment_type' => $validated['employment_type'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Admin updated successfully',
                'redirect' => redirect()
                    ->intended(route('admins.index'))
                    ->with('success', 'Admin updated successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Something went wrong: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin->load('user');
        return view('users.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $admin->load('user');

        return view('users.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->user_id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'local_government' => 'required|string|max:100',
            'religion' => 'required|string|max:100',
            'tribe' => 'required|string|max:100',
            'address' => 'required|string|max:255',

            'staff_number' => 'required|string|max:50|unique:admins,staff_number,' . $admin->user_id . ',user_id',
            'role_type' => 'required|in:super_admin,exam_officer,admission_officer',
            'highest_qualification' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|integer|min:0',
            'start_date' => 'nullable|date',
            'employment_type' => 'required|in:full_time,part_time,contract',
        ]);

        try {
            DB::transaction(function () use ($validated, $admin) {
                $admin->user->update([
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

                $admin->update([
                    'staff_number' => $validated['staff_number'],
                    'role_type' => $validated['role_type'],
                    'highest_qualification' => $validated['highest_qualification'] ?? null,
                    'years_of_experience' => $validated['years_of_experience'] ?? 0,
                    'start_date' => $validated['start_date'] ?? null,
                    'employment_type' => $validated['employment_type'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Admin updated successfully',
                'redirect' => redirect()
                    ->intended(route('admins.index'))
                    ->with('success', 'Admin updated successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Update failed: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        try {
            DB::transaction(function () use ($admin) {
                $admin->user->delete();
                $admin->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Admin Deleted successfully',
                'redirect' => redirect()
                    ->intended(route('admins.index'))
                    ->with('success', 'Admin Deleted successfully!')
                    ->getTargetUrl(),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Admin $admin)
    {
        $user = $admin->load('user');
        $route = route('admins.destroy', $admin);
        $userType = 'Teacher';

        $messages = [
            "This account will be deactivated. Their records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('users.soft-delete', compact('user', 'route', 'messages'));
    }
}
