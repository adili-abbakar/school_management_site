<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\Guardian;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));

        $guardians = Guardian::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('occupation', 'like', "%{$search}%")
                        ->orWhere("relationship", 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name',  'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%")
                                ->orWhereRaw(
                                    "CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(first_name, ' ', last_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(last_name, ' ', middle_name, ' ', first_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(last_name, ' ', first_name) LIKE ?",
                                    ["%{$search}%"]
                                );
                        });
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.guardians.partials.rows', compact('guardians'))->render(),
                'pagination' => view('users.guardians.partials.pagination', compact('guardians'))->render(),
            ]);
        }
        return view('users.guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.guardians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
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
            'occupation' => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'middle_name' => $validated['middle_name'],
                    'last_name' => $validated['last_name'] ?? null,
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['phone']),
                    'phone' => $validated['phone'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'nationality' => $validated['nationality'],
                    'state' => $validated['state'],
                    'local_government' => $validated['local_government'],
                    'religion' => $validated['religion'],
                    'tribe' => $validated['tribe'],
                    'address' => $validated['address'],
                ]);

                Guardian::create([
                    'user_id' => $user->id,
                    'occupation' => $validated['occupation'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Guardian created successfully',
                'redirect' => redirect()
                    ->intended(route('guardians.index'))
                    ->with('success', 'Guardian created successfully!')
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
    public function show(Guardian $guardian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guardian $guardian)
    {
        $guardian->load('user');

        return view('users.guardians.edit', compact('guardian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guardian->user_id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'local_government' => 'required|string|max:100',
            'religion' => 'required|string|max:100',
            'tribe' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($validated, $guardian) {
                $guardian->user->update([
                    'first_name' => $validated['first_name'],
                    'middle_name' => $validated['middle_name'],
                    'last_name' => $validated['last_name'] ?? null,
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                    'nationality' => $validated['nationality'],
                    'state' => $validated['state'],
                    'local_government' => $validated['local_government'],
                    'religion' => $validated['religion'],
                    'tribe' => $validated['tribe'],
                    'address' => $validated['address'],
                ]);

                $guardian->update([
                    'occupation' => $validated['occupation'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Guardian updated successfully',
                'redirect' => redirect()
                    ->intended(route('guardians.index'))
                    ->with('success', 'Guardian updated successfully!')
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
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        try {
            DB::transaction(function () use ($guardian) {
                $guardian->user->delete();
                $guardian->delete();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Guardian Deleted successfully',
                'redirect' => redirect()
                    ->intended(route('guardians.index'))
                    ->with('success', 'Guardian Deleted successfully!')
                    ->getTargetUrl(),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Guardian $guardian)
    {
        $user = $guardian->load('user');
        $route = route('guardians.destroy', $guardian->user_id);
        $userType = 'guardian';

        $messages = [
            "This account will be deactivated. Their records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('users.soft-delete', compact('user', 'route', 'messages', 'userType'));
    }
}
