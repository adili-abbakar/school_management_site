<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Academic\Session;
use App\Models\Academic\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get("search", '');

        $sessions = Session::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like',  "%{$search}%")
                    ->orWhere('start_date', 'like', "%{$search}%")
                    ->orWhere('end_date', 'like', "%{$search}%");
            });
        })
            ->latest('end_date')
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('academic.sessions.partials.rows', compact('sessions'))->render(),
                'pagination' => view('academic.sessions.partials.pagination', compact('sessions'))->render()
            ]);
        }

        return view('academic.sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'session_name' => 'required|string|max:255|unique:academic_sessions,name',

            'session_start_date' => ['required', 'date'],
            'session_end_date'   => ['required', 'date', 'after:session_start_date'],


            'first_term_start_date' => ['required', 'date', 'after_or_equal:session_start_date', 'before_or_equal:session_end_date'],
            'first_term_end_date'   => ['required', 'date', 'after:first_term_start_date', 'before_or_equal:session_end_date'],

            'second_term_start_date' => ['required', 'date', 'after_or_equal:session_start_date', 'after:first_term_end_date', 'before_or_equal:session_end_date'],
            'second_term_end_date'   => ['required', 'date', 'after:second_term_start_date', 'before_or_equal:session_end_date'],

            'third_term_start_date' => ['required', 'date', 'after_or_equal:session_start_date', 'after:second_term_end_date', 'before_or_equal:session_end_date'],
            'third_term_end_date'   => ['required', 'date', 'after:third_term_start_date', 'before_or_equal:session_end_date'],
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
    public function edit(Session $session)
    {
        $session->load('terms');
        return view('academic.sessions.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $validated =  $request->validate([
            'session_name' => 'required|string|max:255|unique:academic_sessions,name' . $session->id,
            'session_start_date' => ['required', 'date'],
            'session_end_date'   => ['required', 'date', 'after:session_start_date'],
        ]);

        try {
            DB::transaction(
                function () use ($validated, $session) {
                    $session->update([
                        'name' => $validated['session_name'],
                        'start_date' => $validated['session_start_date'],
                        'end_date' => $validated['session_end_date'],
                    ]);
                }
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Session updated successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Session updated successfully!')
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
    public function destroy(Session $session)
    {
        try {
            DB::transaction(
                function () use ($session) {
                    $session->terms()->delete();
                    $session->delete();
                }
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Session deleted successfully',
                'redirect' => redirect()
                    ->intended(route('sessions.index'))
                    ->with('success', 'Session deleted successfully!')
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

    public function delete(Session $session)
    {
        $title = 'session';
        $data = $session->load('terms');
        $route = route('sessions.destroy', $session->id);

        $messages = [
            "This session will be deactivated. Its records will be hidden but can be restored later.",
            "All associated data and records will be reversibly removed from the system. They can be restored later if needed."
        ];

        return view('academic.soft-delete', compact('data', 'title', 'route', 'messages'));
    }
}
