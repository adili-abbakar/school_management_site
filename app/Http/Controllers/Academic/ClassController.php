<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Academic\Program;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Pest\Laravel\json;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim($request->get('search', ''));
        $programId = $request->filled('program_id') ? $request->get('program_id') : null;
        $classLevelId = $request->filled('class_level_id') ? $request->get('class_level_id') : null;

        $classes = AcademicClass::orderdChain()
            ->flatten(1);

        $classes->each(function ($class) {
            $class->loadMissing('arms.teacher.user');
        });

        if ($programId) {
            $classes = $classes->filter(function ($class) use ($programId) {
                return $class->program_id == $programId;
            });

            if ($classLevelId) {
                $classes = $classes->filter(function ($class) use ($classLevelId) {
                    return $class->class_level_id == $classLevelId;
                });
            }
        }

        $classes = $classes
            ->filter(function ($class) use ($search) {

                if ($search === '') {
                    return true;
                }

                $normalizedSearch = strtolower(str_replace(' ', '', $search));

                $classText = strtolower(str_replace(
                    ' ',
                    '',
                    ($class->name ?? '') .
                        ($class->level->name ?? '') .
                        ($class->program->name ?? '')
                ));

                $teacherMatch = $class->arms->contains(function ($arm) use ($normalizedSearch) {

                    $user = $arm->teacher?->user;

                    $teacherText = strtolower(str_replace(
                        ' ',
                        '',
                        ($user?->first_name ?? '') .
                            ($user?->middle_name ?? '') .
                            ($user?->last_name ?? '')
                    ));

                    return str_contains($teacherText, $normalizedSearch);
                });

                $armMatch = $class->arms->contains(function ($arm) use ($normalizedSearch) {

                    $armText = strtolower(
                        str_replace(' ', '', $arm->name ?? '')
                    );

                    return str_contains($armText, $normalizedSearch);
                });

                return str_contains($classText, $normalizedSearch)
                    || $teacherMatch
                    || $armMatch;
            })
            ->values();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $classes->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $programs = Program::orderBy('name')->get();


        $classes = new LengthAwarePaginator(
            $currentItems,
            $classes->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        if ($request->ajax()) {
            return response()->json([
                'html' => view('academic.classes.partials.rows', compact('classes'))->render(),
                'pagination' => view('academic.classes.partials.pagination', compact('classes'))->render(),
            ]);
        }

        return view('academic.classes.index', compact('classes', 'programs'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = AcademicClass::get();
        $programs = Program::orderBy('name')->get();
        $teachers = Teacher::with('user')->get();
        return view('academic.classes.create', compact('classes', 'teachers', 'programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'class_name' => 'required|string|max:255|unique:classes,name',
                'class_program' => 'required',
                'class_level' => 'required',
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
                    'program_id' => $validated['class_program'],
                    'class_level_id' => $validated['class_level'],
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
        $programs = Program::orderBy('name')->get();

        return view('academic.classes.edit', compact('class', 'classes', 'teachers', 'programs'));
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
                'class_program' => 'required',
                'class_level' => 'required',
                'previous_class_id' => 'nullable|exists:classes,id|different:' . $class->id,
                'force_overwrite' => 'sometimes|boolean',

                'arms' => 'required|array|min:1',
                'arms.*.id' => 'nullable|integer',
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

        $validator->after(function ($validator) use ($request, $class) {
            foreach ($request->levels ?? [] as $index => $level) {

                $exists = ClassArm::where('class_id', $class->id)
                    ->where('name', $level['name'])
                    ->when(
                        !empty($level['id']),
                        fn($query) => $query->where('id', '!=', $level['id'])
                    )
                    ->exists();

                if ($exists) {
                    $validator->errors()->add(
                        "arms.$index.name",
                        "The arm '{$level['name']}' already exists in this class."
                    );
                }
            }
        });

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
                    'program_id' => $validated['class_program'],
                    'class_level_id' => $validated['class_level'],
                    'next_class_id' => $newNextId
                ]);

                $submittedArms = (collect($validated['arms']));

                $class->arms()->whereNotIn('id', $submittedArms->pluck('id')->filter())->delete();


                foreach ($submittedArms as $arm) {

                    if (!empty($arm['id'])) {

                        $existingArm = ClassArm::findOrFail($arm['id']);

                        $existingArm->update([
                            'name' => $arm['name'],
                            'teacher_id' => $arm['form_teacher'],
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

    public function arms(AcademicClass $class)
    {
        return response()->json(
            $class->arms()->select('id', 'name')->orderBy('name')->get()
        );
    }
}
