<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademicClass::orderdChain()->flatten();
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
                'arms.*.name' => "required|string|max:50|distinct",
                'arms.*.form_teacher' => 'required|exists:teachers,user_id',
            ],
            [
                'arms.required' => 'You must add at least one arm.',
                'arms.array' => 'Arms must be submitted as a list.',
                'arms.min' => 'You must add at least one arm.',

                'arms.*.name.required' => 'Each arm must have a name.',
                'arms.*.name.string' => 'Arm names must be text.',
                'arms.*.name.max' => 'Arm names may not be longer than 50 characters.',
                'arms.*.name.distinct' => 'Arm names must be unique.',

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
                    ->intended(route('classes.index'))
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
        $classes = AcademicClass::where('id', "!=", $class->id)->get();
        $teachers = Teacher::with('user')->get();
        return view('academic.classes.edit', compact('class', 'classes', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicClass $class)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'class_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('classes', 'name')->ignore($class->id),
                ],
                'class_level' => 'required|in:nursery,primary,jss,sss',
                'previous_class_id' => 'nullable|exists:classes,id|different:' . $class->id,
                'force_overwrite' => 'sometimes|boolean',

                'arms' => 'required|array|min:1',
                'arms.*.name' => "required|string|max:50|distinct",
                'arms.*.form_teacher' => 'required|exists:teachers,user_id',
            ],
            [
                'arms.required' => 'You must add at least one arm.',
                'arms.array' => 'Arms must be submitted as a list.',
                'arms.min' => 'You must add at least one arm.',

                'arms.*.name.required' => 'Each arm must have a name.',
                'arms.*.name.string' => 'Arm names must be text.',
                'arms.*.name.max' => 'Arm names may not be longer than 50 characters.',
                'arms.*.name.distinct' => 'Arm names must be unique.',

                'arms.*.form_teacher.required' => 'Each arm must have a form teacher.',
                'arms.*.form_teacher.exists' => 'The selected teacher does not exist.',
            ]
        );

        if (!$request->force_overwrite) {
            $validator->after(function ($validator) use ($request, $class) {
                if (!empty($request->previous_class_id)) {
                    $previousClass = AcademicClass::find($request->previous_class_id);
                    if ($previousClass && $class->wouldCreateCycle($previousClass)) {
                        $validator->errors()->add('previous_class_id', 'Invalid link: would create a cycle in the class chain.');
                    }
                }
            });
        }


        $validated = $validator->validate();
        try {
            DB::transaction(function () use ($validated, $class) {
                $newNextId = $class->next_class_id;

                if (!empty($validated['previous_class_id'])) {
                    $previousClass = AcademicClass::find($validated['previous_class_id']);
                    if ($previousClass && $previousClass->id !== optional($class->previousClass)->id) {
                        $class->previousClass()->update(['next_class_id' => null]);
                        // AcademicClass::where('next_class_id', $class->id)->update(['next_class_id' => null]);
                        $oldNextId = $previousClass->next_class_id;
                        $previousClass->update(['next_class_id' => $class->id]);
                        if ($oldNextId) {
                            $newNextId = $oldNextId;
                        }
                    }
                } else {
                    AcademicClass::where('next_class_id', $class->id)->update(['next_class_id' => null]);
                }

                $class->update([
                    'name' => $validated['class_name'],
                    'level' => $validated['class_level'],
                    'next_class_id' => $newNextId
                ]);

                $submittedArms = (collect($validated['arms']));

                $class->arms()->whereNotIn('id', $submittedArms->pluck('id')->filter())->delete();

                foreach ($submittedArms as $arm) {
                    if (!empty($arm->id)) {
                        $class->arms()->where('id', $arm['id'])->update([
                            'name' => $arm['name'],
                            'teacher_id' => $arm['form_teacher']
                        ]);
                    } else {
                        $class->arms()->create([
                            'name' => $arm['name'],
                            'teacher_id' => $arm['form_teacher']
                        ]);
                    }
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Class updated successfully',
                'redirect' => redirect()
                    ->intended(route('classes.index'))
                    ->with('success', 'Class updated successfully!')
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
    public function destroy(AcademicClass $class)
    {
        try {
            DB::transaction(
                function () use ($class) {
                    $class->arms()->delete();
                    $class->delete();
                }
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Class deleted successfully',
                'redirect' => redirect()
                    ->intended(route('classes.index'))
                    ->with('success', 'Class deleted successfully!')
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

    public function delete(AcademicClass $class)
    {
        $title = 'class';
        $data = $class->load('arms');
        $route = route('classes.destroy', $class->id);

        $messages = [
            "This class will be deactivated. Its records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('academic.classes.soft-delete', compact('data', 'title', 'route', 'messages'));
    }
}
