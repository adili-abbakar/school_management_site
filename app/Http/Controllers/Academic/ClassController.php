<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademicClass::get();
        return view('academic.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = AcademicClass::get();
        $teachers = Teacher::with('user')->get();
        return view('academic.classes.create', compact('classes', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'class_name' => 'required|string|max:255|unique:classes,name',
                'class_level' => 'required|in:nursery,primary,jss,sss',
                'previous_class_id' => 'nullable|exists:classes,id',
                'force_overwrite' => 'sometimes|boolean',

                'arms' => 'required|array|min:1',
                'arms.*.name' => "required|string|max:50",
                'arms.*.form_teacher' => 'required|exists:teachers,user_id',
            ],
            [
                'arms.required' => 'You must add at least one arm.',
                'arms.array' => 'Arms must be submitted as a list.',
                'arms.min' => 'You must add at least one arm.',

                'arms.*.name.required' => 'Each arm must have a name.',
                'arms.*.name.string' => 'Arm names must be text.',
                'arms.*.name.max' => 'Arm names may not be longer than 50 characters.',

                'arms.*.form_teacher.required' => 'Each arm must have a form teacher.',
                'arms.*.form_teacher.exists' => 'The selected teacher does not exist.',
            ]
        );


        try {
            DB::transaction(function () use ($validated) {
                $newClass = AcademicClass::create([
                    'name'  => $validated['class_name'],
                    'level' => $validated['class_level'],
                ]);

                foreach ($validated['arms'] as $arm) {
                    ClassArm::create([
                        'name'       => $arm['name'],
                        'max_students' => $arm['max_students'] ?? null,
                        'class_id'   => $newClass->id,
                        'teacher_id' => $arm['form_teacher'],
                    ]);
                }

                if (!empty($validated['previous_class_id'])) {
                    $previousClass = AcademicClass::find($validated['previous_class_id']);
                    if ($previousClass) {
                        $oldNextId = $previousClass->next_class_id;
                        $previousClass->update(['next_class_id' => $newClass->id]);
                        if ($oldNextId) {
                            $newClass->update(['next_class_id' => $oldNextId]);
                        }
                    }
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Class created successfully',
                'redirect' => redirect()
                    ->intended(route('admins.index'))
                    ->with('success', 'Class created successfully!')
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
    public function show(AcademicClass $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicClass $class)
    {
        return view('academic.classes.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicClass $class)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicClass $class)
    {
        //
    }
}
