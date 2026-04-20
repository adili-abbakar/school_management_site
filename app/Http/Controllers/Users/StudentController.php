<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Academic\AcademicClass;
use App\Models\Users\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));
        $searchNoSpace = str_replace(' ', '', $search);
        $classArmId = $request->get('class_arm_id');
        $status = $request->get('status');

        $classes = AcademicClass::orderdChain()->flatten();

        $students = Student::with(['user', 'currentClassArm.class'])
            ->when($search, function ($query) use ($search, $searchNoSpace) {
                $query->where(function ($q) use ($search, $searchNoSpace) {
                    $q->where('admission_number', 'like', "%{$search}%")
                        ->orWhere('current_status', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('middle_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%")
                                ->orWhereRaw(
                                    "CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(first_name, ' ', last_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(last_name, ' ', COALESCE(middle_name, ''), ' ', first_name) LIKE ?",
                                    ["%{$search}%"]
                                )
                                ->orWhereRaw(
                                    "CONCAT(last_name, ' ', first_name) LIKE ?",
                                    ["%{$search}%"]
                                );
                        })
                        ->orWhereHas('currentClassArm', function ($classArmQuery) use ($search, $searchNoSpace) {
                            $classArmQuery->join('classes', 'classes.id', '=', 'class_arms.class_id')
                                ->where(function ($classQuery) use ($search, $searchNoSpace) {
                                    $classQuery->where('class_arms.name', 'like', "%{$search}%")
                                        ->orWhere('classes.name', 'like', "%{$search}%")
                                        ->orWhereRaw(
                                            "CONCAT(classes.name, ' ', class_arms.name) LIKE ?",
                                            ["%{$search}%"]
                                        )
                                        ->orWhereRaw(
                                            "REPLACE(CONCAT(classes.name, ' ', class_arms.name), ' ', '') LIKE ?",
                                            ["%{$searchNoSpace}%"]
                                        );
                                });
                        });
                });
            })
            ->when($classArmId, function ($query) use ($classArmId) {
                $query->where('current_class_arm_id', $classArmId);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('current_status', $status);
            })
            ->latest()
            ->paginate(30)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('users.students.partials.rows', compact('students'))->render(),
                'pagination' => view('users.students.partials.pagination', compact('students'))->render()
            ]);
        }

        return view('users.students.index', compact('students', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
