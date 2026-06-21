<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\ClassLevel;
use App\Models\Academic\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $programs = Program::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('is_active', 'like', "%{$search}%");
            });
        })->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('academic.programs.partials.rows', compact('programs'))->render(),
                'pagination' => view('academic.programs.partials.pagination', compact('programs'))->render(),
            ]);
        }


        return view('academic.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'program_name' => 'required|string|max:255|unique:programs,name',
                'program_description' => 'required|string|max:500',

                'levels' => 'required|array|min:1',
                'levels.*.name' => "required|string|max:50|distinct",
                'levels.*.description' => "required|string|max:500",
            ],
            [
                'levels.required' => 'You must add at least one level.',
                'levels.array' => 'levels must be submitted as a list.',
                'levels.min' => 'You must add at least one level.',

                'levels.*.name.required' => 'Each level must have a name.',
                'levels.*.name.string' => 'Level names must be text.',
                'levels.*.name.max' => 'Level names may not be longer than 50 characters.',
                'levels.*.name.distinct' => 'Level names must be unique.',

                'levels.*.description.required' => 'Each level must have a description.',
                'levels.*.description.string' => 'Level description must be text.',
                'levels.*.description.max' => 'Level description may not be longer than 500 characters.',


            ]
        );


        try {
            DB::transaction(function () use ($validated) {
                $newProgram = Program::create([
                    'name'  => $validated['program_name'],
                    'description'  => $validated['program_description'],
                ]);

                foreach ($validated['levels'] as $level) {
                    ClassLevel::create([
                        'name'       => $level['name'],
                        'program_id'   => $newProgram->id,
                        'description'  => $level['description'],
                    ]);
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Program created successfully',
                'redirect' => redirect()
                    ->intended(route('programs.index'))
                    ->with('success', 'Program created successfully!')
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
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('academic.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'program_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('programs', 'name')->ignore($program->id),
                ],
                'program_description' => 'required|string|max:500',

                'levels' => 'required|array|min:1',
                'levels.*.id' => 'nullable|integer',
                'levels.*.name' => "required|string|max:50|distinct",
                'levels.*.description' => "required|string|max:500",
            ],
            [
                'levels.required' => 'You must add at least one level.',
                'levels.array' => 'levels must be submitted as a list.',
                'levels.min' => 'You must add at least one level.',

                'levels.*.name.required' => 'Each level must have a name.',
                'levels.*.name.string' => 'Level names must be text.',
                'levels.*.name.max' => 'Level names may not be longer than 50 characters.',
                'levels.*.name.distinct' => 'Level names must be unique.',

                'levels.*.description.required' => 'Each level must have a description.',
                'levels.*.description.string' => 'Level description must be text.',
                'levels.*.description.max' => 'Level description may not be longer than 500 characters.',


            ]
        );

        $validator->after(function ($validator) use ($request, $program) {
            foreach ($request->levels ?? [] as $index => $level) {

                $exists = ClassLevel::where('program_id', $program->id)
                    ->where('name', $level['name'])
                    ->when(
                        !empty($level['id']),
                        fn($query) => $query->where('id', '!=', $level['id'])
                    )
                    ->exists();

                if ($exists) {
                    $validator->errors()->add(
                        "levels.$index.name",
                        "The level '{$level['name']}' already exists in this program."
                    );
                }
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        try {
            DB::transaction(function () use ($validated, $program) {
                $program->update([
                    'name'  => $validated['program_name'],
                    'description'  => $validated['program_description'],
                ]);

                $levels = (collect($validated['levels']));

                $program->levels()->whereNotIn('id', $levels->pluck('id')->filter())->delete();


                foreach ($levels as $level) {

                    if (!empty($level['id'])) {

                        $existingLevel = ClassLevel::findOrFail($level['id']);

                        $existingLevel->update([
                            'name' => $level['name'],
                            'description' => $level['description'],
                        ]);
                    } else {

                        $program->levels()->create([
                            'name' => $level['name'],
                            'description' => $level['description'],
                        ]);
                    }
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Program updated successfully',
                'redirect' => redirect()
                    ->intended(route('programs.index'))
                    ->with('success', 'Program updated successfully!')
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
    public function destroy(Program $program)
    {
        //
    }

    public function delete() {}

    public function levels(Program $program)
    {
        return response()->json(
            $program->levels()
                ->select('id', 'name')
                ->orderBy('name')
                ->get()
        );
    }
}
