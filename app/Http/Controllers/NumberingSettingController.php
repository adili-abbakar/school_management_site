<?php

namespace App\Http\Controllers;

use App\Models\NumberingSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NumberingSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numberingSettings = NumberingSetting::latest()->get();

        return view('numbering-settings.index', compact('numberingSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('numbering-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:admission_number,staff_id,application_number|unique:numbering_settings,type',
            'prefix' => 'nullable|string|max:10',
            'separator' => 'nullable|string|max:5',
            'include_year' => 'nullable|boolean',
            'padding' => 'required|integer|min:1|max:10',
            'next_number' => 'required|integer|min:1',
        ]);

        $validated['include_year'] = $request->has('include_year');

        try {
            NumberingSetting::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Numbering pattern created successfully',
                'redirect' => redirect()
                    ->intended(route('numbering-settings.index'))
                    ->with('success', 'Numbering pattern created successfully!')
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
    public function edit(NumberingSetting $numbering_setting)
    {
        return view('numbering-settings.edit', ['setting' => $numbering_setting]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NumberingSetting $numbering_setting)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                'in:admission_number,staff_id,application_number',
                Rule::unique('numbering_settings', 'type')->ignore($numbering_setting->id),
            ],
            'prefix' => 'nullable|string|max:10',
            'separator' => 'nullable|string|max:5',
            'include_year' => 'nullable|boolean',
            'padding' => 'required|integer|min:1|max:10',
            'next_number' => 'required|integer|min:1',
        ]);

        $validated['include_year'] = $request->has('include_year');

        try {
            $numbering_setting->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Numbering pattern updated successfully',
                'redirect' => redirect()
                    ->intended(route('numbering-settings.index'))
                    ->with('success', 'Numbering pattern updated successfully!')
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
}
