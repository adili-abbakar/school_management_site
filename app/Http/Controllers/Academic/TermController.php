<?php

namespace App\Http\Controllers\Academic;

use App\Models\Academic\Session;
use App\Models\Academic\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TermController extends Controller
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
        return view('academic.terms.create', compact('session'));
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
    public function edit(Session $session, Term $term)
    {
        return view('academic.terms.edit', compact('term', 'session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session, Term $term)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'session_start_date' => "required|date",
            'session_end_date' => "required|date|after:session_start_date",
            'start_date' => 'required|date|after_or_equal:session_start_date',
            'end_date' => 'required|date|after:start_date|before_or_equal:session_end_date',
        ]);

        try {
            $term->update([
                'name' => $validated['name'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ]);
            $term->session()->touch();
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
    public function destroy(Session $session, Term $term)
    {
        try {
            $term->delete();
            $term->session()->touch();


            return response()->json([
                'status' => 'success',
                'message' => 'Term deleted successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term deleted successfully!')
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

    public function delete(Session $session, Term $term)
    {
        $title = 'term';
        $data = $term->load('session');
        $route = route('sessions.terms.destroy', [$session, $term]);;

        $messages = [
            "This term will be deactivated. Its records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('academic.soft-delete', compact('data', 'title', 'route', 'messages'));
    }

    public function setActive(Term $term)
    {
        try {
            Term::where('activity', 'active')->update(['activity' => 'completed']);
            $term->update(['activity' => 'active']);
            $term->session()->touch();


            return response()->json([
                'status' => 'success',
                'message' => 'Term activated successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term activated successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong ' . $e->getMessage()
            ], 500);
        }
    }

    public function setCompleted(Term $term)
    {
        try {
            $term->update(['activity' => 'completed']);
            $term->session()->touch();


            return response()->json([
                'status' => 'success',
                'message' => 'Term completed successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term completed successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong ' . $e->getMessage()
            ], 500);
        }
    }

    public function setUpcoming(Term $term)
    {
        try {
            $term->update(['activity' => 'upcoming']);
            $term->session()->touch();

            return response()->json([
                'status' => 'success',
                'message' => 'Term set to upcoming successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Term set to upcoming successfully!')
                    ->getTargetUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong ' . $e->getMessage()
            ], 500);
        }
    }
}
