<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Term;
use Illuminate\Http\Request;

class TeacherControllerTermController extends Controller
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
    public function create(Session $session)
    {
        return view('terms.create', compact('session'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Session $session)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        try {
            $session->terms()->create([
                'name' => $validated['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Term created successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term created successfully!')
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
    public function edit(Term $term, Session $session)
    {
        return view('terms.edit', compact('term', 'session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Term $term, Session $session)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

          try {
            $session->terms()->update([
                'name' => $validated['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Term updated successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term updated successfully!')
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
