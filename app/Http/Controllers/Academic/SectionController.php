<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\ClassLevel;
use App\Models\Academic\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $sections = Section::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('is_active', 'like', "%{$search}%");
            });
        })->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('academic.sections.partials.rows', compact('sections'))->render(),
                'pagination' => view('academic.sections.partials.pagination', compact('sections'))->render(),
            ]);
        }


        return view('academic.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'section_name' => 'required|string|max:255|unique:sections,name',
                'section_description' => 'required|string|max:500',

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
                $newSection = Section::create([
                    'name'  => $validated['section_name'],
                    'description'  => $validated['section_description'],
                ]);

                foreach ($validated['levels'] as $level) {
                    ClassLevel::create([
                        'name'       => $level['name'],
                        'section_id'   => $newSection->id,
                        'description'  => $level['description'],
                    ]);
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Section created successfully',
                'redirect' => redirect()
                    ->intended(route('sections.index'))
                    ->with('success', 'Section created successfully!')
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
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('academic.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'section_name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('sections', 'name')->ignore($section->id),
                ],
                'section_description' => 'required|string|max:500',

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

        $validator->after(function ($validator) use ($request, $section) {
            // throw new \Exception(json_encode($request->levels));
            foreach ($request->levels ?? [] as $index => $level) {

                $exists = ClassLevel::where('section_id', $section->id)
                    ->where('name', $level['name'])
                    ->when(
                        !empty($level['id']),
                        fn($query) => $query->where('id', '!=', $level['id'])
                    )
                    ->exists();

                if ($exists) {
                    $validator->errors()->add(
                        "levels.$index.name",
                        "The level '{$level['name']}' already exists in this section."
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
            DB::transaction(function () use ($validated, $section) {
                $section->update([
                    'name'  => $validated['section_name'],
                    'description'  => $validated['section_description'],
                ]);

                $levels = (collect($validated['levels']));

                $section->levels()->whereNotIn('id', $levels->pluck('id')->filter())->delete();


                foreach ($levels as $level) {

                    if (!empty($level['id'])) {

                        $existingLevel = ClassLevel::findOrFail($level['id']);

                        $existingLevel->update([
                            'name' => $level['name'],
                            'description' => $level['description'],
                        ]);
                    } else {

                        $section->levels()->create([
                            'name' => $level['name'],
                            'description' => $level['description'],
                        ]);
                    }
                }
            });


            return response()->json([
                'status' => 'success',
                'message' => 'Section updated successfully',
                'redirect' => redirect()
                    ->intended(route('sections.index'))
                    ->with('success', 'Section updated successfully!')
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
    public function destroy(Section $section)
    {
        //
    }

    public function delete(){
        
    }
}
