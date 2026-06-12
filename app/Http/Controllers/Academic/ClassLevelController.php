<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\ClassLevel;
use App\Models\Academic\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class ClassLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Section $section)
    {
        return view('academic.levels.create', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('class_levels', 'name')
                    ->where(fn($query) => $query->where('section_id', $section->id))
            ],
            'description' => "required|string|max:500",
        ]);

        try {
            DB::transaction(function () use ($validated, $section) {

                $section->levels()->create([
                    'name' => $validated['name'],
                    'description'  => $validated['description'],
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Level created successfully',
                'redirect' => redirect()
                    ->intended(route('sections.index'))
                    ->with('success', 'Level created successfully!')
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section, ClassLevel $level)
    {
        return view('academic.levels.edit',  compact('section', 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section, ClassLevel $level)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('class_levels', 'name')
                    ->where(fn($query) => $query->where('section_id', $section->id))
                    ->ignore($level->id)
            ],
            'description' => "required|string|max:500",
        ]);

        try {
            DB::transaction(function () use ($validated, $level, $section) {

                $level->update([
                    'name' => $validated['name'],
                    'description'  => $validated['description'],
                ]);
                $level->section()->touch();
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Level updated successfully',
                'redirect' => redirect()
                    ->intended(route('sections.index'))
                    ->with('success', 'Level updated successfully!')
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
    public function destroy(string $id)
    {
        //
    }

    public function delete(){
        
    }
}
