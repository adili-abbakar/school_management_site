<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = Session::get();

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'session_name' => 'required|string|max:255|unique:academic_sessions,name',
            'session_start_date' => 'required|date',
            'session_end_date' => 'required|date',

            'first_term_start_date' => 'required|date',
            'first_term_end_date' => 'required|date',

            'second_term_start_date' => 'required|date',
            'second_term_end_date' => 'required|date',

            'third_term_start_date' => 'required|date',
            'third_term_end_date' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $session = Session::create([
                    'name' => $validated['session_name'],
                    'start_date' => $validated['session_start_date'],
                    'end_date' => $validated['session_end_date'],
                ]);

                Term::create([
                    'session_id' => $session->id,
                    'name' => 'First Term',
                    'start_date' => $validated['first_term_start_date'],
                    'end_date' => $validated['first_term_end_date'],
                ]);

                Term::create([
                    'session_id' => $session->id,
                    'name' => 'Second Term',
                    'start_date' => $validated['second_term_start_date'],
                    'end_date' => $validated['second_term_end_date'],
                ]);


                Term::create([
                    'session_id' => $session->id,
                    'name' => 'Third Term',
                    'start_date' => $validated['third_term_start_date'],
                    'end_date' => $validated['third_term_end_date'],
                ]);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Session created successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Session created successfully!')
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
